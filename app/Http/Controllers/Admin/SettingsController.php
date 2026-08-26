<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class SettingsController extends Controller
{
    public function index(): View
    {
        $settings = [
            'whatsapp_number' => Setting::get('whatsapp_number', ''),
            'crisp_website_id' => Setting::get('crisp_website_id', ''),
        ];

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'whatsapp_number' => 'nullable|string|max:20',
            'crisp_website_id' => 'nullable|string|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value ?? '');
        }

        return redirect()
            ->route('admin.settings.index')
            ->with('success', 'Settings updated successfully!');
    }
    public function stripe(): View
    {
        $settings = [
            'stripe_enabled' => Setting::get('stripe_enabled', '0'),
            'stripe_mode' => Setting::get('stripe_mode', 'test'),
            'stripe_publishable_key' => Setting::get('stripe_publishable_key', ''),
            'stripe_secret_key' => Setting::get('stripe_secret_key', ''),
            'stripe_webhook_secret' => Setting::get('stripe_webhook_secret', ''),
        ];


        return view('admin.settings.stripe', ['stripeSettings' => $settings]);
    }

    public function updateStripe(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'stripe_enabled' => 'boolean',
            'stripe_mode' => 'required|in:test,live',
            'stripe_publishable_key' => 'nullable|string|max:255',
            'stripe_secret_key' => 'nullable|string|max:255',
            'stripe_webhook_secret' => 'nullable|string|max:255',
        ]);

        Setting::set('stripe_enabled', $request->boolean('stripe_enabled') ? '1' : '0');
        Setting::set('stripe_mode', $validated['stripe_mode']);
        Setting::set('stripe_publishable_key', $validated['stripe_publishable_key'] ?? '');
        Setting::set('stripe_secret_key', $validated['stripe_secret_key'] ?? '');
        Setting::set('stripe_webhook_secret', $validated['stripe_webhook_secret'] ?? '');

        return redirect()
            ->route('admin.settings.stripe')
            ->with('success', 'Stripe settings updated successfully!');
    }

    public function email(): View
    {
        $settings = [
            'mail_driver' => Setting::get('mail_driver', 'smtp'),
            'mail_host' => Setting::get('mail_host', ''),
            'mail_port' => Setting::get('mail_port', '587'),
            'mail_username' => Setting::get('mail_username', ''),
            'mail_password' => Setting::get('mail_password', ''),
            'mail_encryption' => Setting::get('mail_encryption', 'tls'),
            'mail_from_address' => Setting::get('mail_from_address', ''),
            'mail_from_name' => Setting::get('mail_from_name', config('app.name')),
            'admin_notification_email' => Setting::get('admin_notification_email', ''),
        ];


        return view('admin.settings.email', ['emailSettings' => $settings]);
    }

    public function updateEmail(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'mail_driver' => 'nullable|string|max:50',
            'mail_host' => 'required|string|max:255',
            'mail_port' => 'required|numeric',
            'mail_username' => 'nullable|string|max:255',
            'mail_password' => 'nullable|string|max:255',
            'mail_encryption' => 'nullable|string|max:10',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
            'admin_notification_email' => 'nullable|email|max:255',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value ?? '');
        }
        
        if (empty(Setting::get('mail_driver'))) {
            Setting::set('mail_driver', 'smtp');
        }

        return redirect()
            ->route('admin.settings.email')
            ->with('success', 'Email settings updated successfully!');
    }

    public function testEmail(Request $request)
    {
        try {
            $testEmail = $request->input('test_email') ?: Setting::get('admin_notification_email') ?: auth()->user()->email;
            
            if (!$testEmail) {
                return response()->json([
                    'success' => false,
                    'error' => 'No email address found to send test email to.'
                ]);
            }

            $host = $request->input('mail_host') ?: Setting::get('mail_host', '');
            $port = $request->input('mail_port') ?: Setting::get('mail_port', '587');
            $username = $request->input('mail_username') !== null ? $request->input('mail_username') : Setting::get('mail_username', '');
            $password = $request->input('mail_password') !== null ? $request->input('mail_password') : Setting::get('mail_password', '');
            $encryption = $request->input('mail_encryption') ?: Setting::get('mail_encryption', 'tls');
            $fromAddress = $request->input('mail_from_address') ?: Setting::get('mail_from_address', '');
            $fromName = $request->input('mail_from_name') ?: Setting::get('mail_from_name', config('app.name'));

            if (empty($host) || empty($fromAddress)) {
                return response()->json([
                    'success' => false,
                    'error' => 'Please fill in SMTP Host and From Email Address before testing.'
                ]);
            }

            config([
                'mail.default' => 'smtp',
                'mail.mailers.smtp.host' => $host,
                'mail.mailers.smtp.port' => (int) $port,
                'mail.mailers.smtp.username' => $username,
                'mail.mailers.smtp.password' => $password,
                'mail.mailers.smtp.encryption' => $encryption === 'null' ? null : $encryption,
                'mail.from.address' => $fromAddress,
                'mail.from.name' => $fromName,
            ]);

            \Illuminate\Support\Facades\Mail::raw("Congratulations! Your SMTP email configuration for " . config('app.name') . " is working perfectly.\n\nSMTP Host: {$host}\nPort: {$port}\nEncryption: {$encryption}", function ($message) use ($testEmail, $fromAddress, $fromName) {
                $message->to($testEmail)
                        ->from($fromAddress, $fromName)
                        ->subject("Test Email Configuration - " . config('app.name'));
            });

            return response()->json([
                'success' => true,
                'message' => "Test email successfully sent to {$testEmail}!"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    public function nowpayments(): View
    {
        $settings = [
            'nowpayments_enabled' => Setting::get('nowpayments_enabled', '0'),
            'nowpayments_api_key' => Setting::get('nowpayments_api_key', ''),
            'nowpayments_ipn_secret' => Setting::get('nowpayments_ipn_secret', ''),
            'nowpayments_email' => Setting::get('nowpayments_email', ''),
            'nowpayments_password' => Setting::get('nowpayments_password', ''),
            'nowpayments_sandbox' => Setting::get('nowpayments_sandbox', '1'),
        ];


        return view('admin.settings.nowpayments', ['nowpaymentsSettings' => $settings]);
    }

    public function updateNowpayments(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nowpayments_sandbox' => 'boolean',
            'nowpayments_api_key' => 'nullable|string|max:255',
            'nowpayments_ipn_secret' => 'nullable|string|max:255',
            'nowpayments_email' => 'nullable|string|max:255',
            'nowpayments_password' => 'nullable|string|max:255',
        ]);

        Setting::set('nowpayments_enabled', $request->boolean('nowpayments_enabled') ? '1' : '0');
        Setting::set('nowpayments_sandbox', $request->boolean('nowpayments_sandbox') ? '1' : '0');
        Setting::set('nowpayments_api_key', trim($validated['nowpayments_api_key'] ?? ''));
        Setting::set('nowpayments_ipn_secret', trim($validated['nowpayments_ipn_secret'] ?? ''));
        Setting::set('nowpayments_email', trim($validated['nowpayments_email'] ?? ''));
        Setting::set('nowpayments_password', $validated['nowpayments_password'] ?? '');

        return redirect()
            ->route('admin.settings.nowpayments')
            ->with('success', 'NOWPayments settings updated successfully!');
    }

    public function testNowpayments(Request $request)
    {
        try {
            $service = new \App\Services\NOWPaymentsService();
            $result = $service->getStatus();
            return response()->json($result);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'error' => $e->getMessage()
            ]);
        }
    }
}
