<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Package;
use App\Models\Country;
use App\Models\Setting;
use App\Mail\NewOrderNotification;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Stripe\Exception\ApiErrorException;

class StripeController extends Controller
{
    public function __construct()
    {
        $this->initializeStripe();
    }

    protected function initializeStripe(): void
    {
        $secretKey = trim(Setting::get('stripe_secret_key', ''));
        if ($secretKey) {
            Stripe::setApiKey($secretKey);
        } else {
            \Log::warning('StripeController: Secret key is missing in settings.');
        }
    }

    /**
     * Create Stripe checkout session for an existing order
     */
    public function checkout(string $orderNumber): RedirectResponse
    {
        $order = Order::where('order_number', $orderNumber)->with('package')->firstOrFail();

        // Check if order belongs to current user
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        // Check if Stripe is configured
        $secretKey = trim(Setting::get('stripe_secret_key', ''));
        if (!$secretKey) {
            \Log::error('StripeController: Attempted checkout but Stripe Secret Key is not set.');
            return redirect()
                ->route('checkout.pending', $order->order_number)
                ->with('error', 'Payment gateway is not configured. Please contact support.');
        }

        Stripe::setApiKey($secretKey);

        try {
            \Log::info('StripeController: Creating session for Order ' . $order->order_number . ' Amount: ' . $order->amount);
            
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $order->package->name ?? 'IPTV Subscription Package',
                            'description' => substr($order->package->description ?? 'IPTV Subscription Package', 0, 500),
                        ],
                        'unit_amount' => (int) round($order->amount * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success', ['order' => $order->order_number]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel', ['order' => $order->order_number]),
                'customer_email' => $order->customer_email,
                'metadata' => [
                    'order_number' => $order->order_number,
                    'package_id' => $order->package_id,
                    'user_id' => $order->user_id,
                ],
            ]);

            $order->update(['stripe_session_id' => $session->id]);

            return redirect($session->url);
        } catch (ApiErrorException $e) {
            \Log::error('StripeController: Stripe API Error: ' . $e->getMessage());
            
            $order->update([
                'payment_status' => 'failed',
                'admin_notes' => 'Stripe Error: ' . $e->getMessage(),
            ]);

            return redirect()
                ->route('checkout.pending', $order->order_number)
                ->with('error', 'Payment initialization failed: ' . $e->getMessage());
        }
    }

    /**
     * Process checkout form submission and create Stripe session
     */
    public function processCheckout(Request $request, string $slug): RedirectResponse
    {
        $package = Package::where('slug', $slug)->active()->firstOrFail();

        $validated = $request->validate([
            'selected_countries' => 'nullable|array',
            'notes' => 'nullable|string|max:1000',
        ]);

        // Create pending order
        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => auth()->id(),
            'package_id' => $package->id,
            'customer_name' => auth()->user()->name,
            'customer_email' => auth()->user()->email,
            'customer_phone' => auth()->user()->phone,
            'amount' => $package->price,
            'payment_method' => 'stripe',
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'notes' => $validated['notes'] ?? null,
            'selected_countries' => $validated['selected_countries'] ?? null,
        ]);

        // Attach countries if selected
        if (!empty($validated['selected_countries'])) {
            $order->countries()->attach($validated['selected_countries']);
        }

        try {
            $session = StripeSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $package->name,
                            'description' => $package->description ?? 'IPTV Subscription Package',
                        ],
                        'unit_amount' => (int) ($package->price * 100),
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('stripe.success', ['order' => $order->order_number]) . '?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('stripe.cancel', ['order' => $order->order_number]),
                'customer_email' => auth()->user()->email,
                'metadata' => [
                    'order_number' => $order->order_number,
                    'package_id' => $package->id,
                    'user_id' => auth()->id(),
                ],
            ]);

            $order->update(['stripe_session_id' => $session->id]);

            return redirect($session->url);
        } catch (ApiErrorException $e) {
            $order->update([
                'payment_status' => 'failed',
                'admin_notes' => 'Stripe Error: ' . $e->getMessage(),
            ]);

            return redirect()
                ->route('checkout.show', $slug)
                ->with('error', 'Payment initialization failed. Please try again.');
        }
    }

    public function success(Request $request, string $order): View|RedirectResponse
    {
        $order = Order::where('order_number', $order)->with('package')->firstOrFail();
        $package = $order->package;

        if ($request->has('session_id')) {
            try {
                $session = StripeSession::retrieve($request->session_id);

                if ($session->payment_status === 'paid') {
                    if ($order->payment_status === 'paid') {
                        return view('checkout.success', compact('order', 'package'));
                    }

                    $order->update([
                        'stripe_payment_id' => $session->payment_intent,
                        'payment_status' => 'paid',
                        'order_status' => 'processing',
                    ]);

                    // Send confirmation email to customer
                    try {
                        $order->sendConfirmationEmail();
                    } catch (\Exception $e) {
                        \Log::error('Failed to send confirmation email: ' . $e->getMessage());
                    }

                    // Create affiliate commission
                    try {
                        $affiliateService = app(\App\Services\AffiliateService::class);
                        $affiliateService->createCommission($order);
                    } catch (\Exception $e) {
                        \Log::error('Failed to create commission: ' . $e->getMessage());
                    }

                    // Send notification to admin
                    $adminEmail = Setting::get('admin_notification_email');
                    if ($adminEmail) {
                        try {
                            Mail::to($adminEmail)->send(new NewOrderNotification($order));
                        } catch (\Exception $e) {
                            // Log but don't fail
                        }
                    }
                }
            } catch (ApiErrorException $e) {
                // Log error
            }
        }

        return view('checkout.success', compact('order', 'package'));
    }

    public function cancel(string $order): View
    {
        $order = Order::where('order_number', $order)->with('package')->firstOrFail();

        $order->update([
            'payment_status' => 'failed',
            'order_status' => 'cancelled',
        ]);

        return view('checkout.cancel', compact('order'));
    }

    public function webhook(Request $request)
    {
        $payload = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $webhookSecret = Setting::get('stripe_webhook_secret');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sigHeader, $webhookSecret
            );
        } catch (\Exception $e) {
            return response()->json(['error' => 'Webhook verification failed'], 400);
        }

        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;
                $this->handleSuccessfulPayment($session);
                break;

            case 'payment_intent.payment_failed':
                $paymentIntent = $event->data->object;
                $this->handleFailedPayment($paymentIntent);
                break;
        }

        return response()->json(['status' => 'success']);
    }

    protected function handleSuccessfulPayment($session): void
    {
        $order = Order::where('stripe_session_id', $session->id)->first();

        if ($order && $order->payment_status !== 'paid') {
            $order->update([
                'stripe_payment_id' => $session->payment_intent,
                'payment_status' => 'paid',
                'order_status' => 'processing',
            ]);

            // Send confirmation email to customer
            try {
                $order->sendConfirmationEmail();
            } catch (\Exception $e) {
                \Log::error('Failed to send confirmation email: ' . $e->getMessage());
            }

            // Create affiliate commission
            try {
                $affiliateService = app(\App\Services\AffiliateService::class);
                $affiliateService->createCommission($order);
            } catch (\Exception $e) {
                \Log::error('Failed to create commission: ' . $e->getMessage());
            }

            // Send admin notification
            $adminEmail = Setting::get('admin_notification_email');
            if ($adminEmail) {
                try {
                    Mail::to($adminEmail)->send(new NewOrderNotification($order));
                } catch (\Exception $e) {
                    // Log error
                }
            }
        }
    }

    protected function handleFailedPayment($paymentIntent): void
    {
        $order = Order::where('stripe_payment_id', $paymentIntent->id)->first();

        if ($order) {
            $order->update([
                'payment_status' => 'failed',
                'admin_notes' => 'Payment failed: ' . ($paymentIntent->last_payment_error->message ?? 'Unknown error'),
            ]);
        }
    }
}
