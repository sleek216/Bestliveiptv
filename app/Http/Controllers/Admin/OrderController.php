<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use App\Models\Package;
use App\Mail\OrderDetailsMail;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    public function index(Request $request): View
    {
        if (Schema::hasColumn('orders', 'admin_seen_at')) {
            Order::whereNull('admin_seen_at')->update(['admin_seen_at' => now()]);
        }

        $query = Order::with(['user', 'package']);

        // Filter by status
        if ($request->filled('status')) {
            $query->where('order_status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Search by order number or customer
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%")
                  ->orWhere('customer_email', 'like', "%{$search}%");
            });
        }

        $orders = $query->latest()->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        $order->load(['user', 'package', 'countries']);
        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,processing,completed,cancelled',
            'admin_notes' => 'nullable|string|max:1000',
        ]);

        $order->update($validated);

        // If marked as completed, set activation dates
        if ($validated['order_status'] === 'completed' && !$order->activated_at) {
            $order->markAsCompleted();
        }

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order status updated successfully!');
    }

    public function updatePaymentStatus(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'payment_status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $order->update($validated);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Payment status updated successfully!');
    }

    public function sendEmail(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'include_credentials' => 'boolean',
            'username' => 'nullable|string|max:255',
            'password' => 'nullable|string|max:255',
            'm3u_url' => 'nullable|string|max:500',
            'portal_url' => 'nullable|url|max:500',
        ]);

        try {
            Mail::to($order->customer_email)
                ->send(new OrderDetailsMail($order, $validated));

            $order->update(['email_sent_at' => now()]);

            return redirect()
                ->route('admin.orders.show', $order)
                ->with('success', 'Email sent successfully to ' . $order->customer_email);
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.orders.show', $order)
                ->with('error', 'Failed to send email: ' . $e->getMessage());
        }
    }

    public function invoice(Order $order): View
    {
        $order->load(['user', 'package', 'countries']);
        return view('admin.orders.invoice', compact('order'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->countries()->detach();
        $order->delete();

        return redirect()
            ->route('admin.orders.index')
            ->with('success', 'Order deleted successfully!');
    }
    public function create(): View
    {
        $packages = Package::active()->get();
        return view('admin.orders.create', compact('packages'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'package_id' => 'required|exists:packages,id',
            'adjustment_amount' => 'nullable|numeric',
            'order_status' => 'required|in:pending,processing,completed,cancelled',
            'payment_status' => 'required|in:pending,completed,failed,refunded',
            'notes' => 'nullable|string',
        ]);

        $package = Package::find($validated['package_id']);
        $user = User::find($validated['user_id']);
        
        $adjustment = $validated['adjustment_amount'] ?? 0;
        $totalAmount = $package->price + $adjustment;

        $order = Order::create([
            'order_number' => Order::generateOrderNumber(),
            'user_id' => $user->id,
            'package_id' => $package->id,
            'customer_name' => $user->name,
            'customer_email' => $user->email,
            'amount' => $totalAmount,
            'adjustment_amount' => $adjustment,
            'order_status' => $validated['order_status'],
            'payment_status' => $validated['payment_status'],
            'notes' => $validated['notes'],
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order created successfully!');
    }

    public function edit(Order $order): View
    {
        $packages = Package::all();
        return view('admin.orders.edit', compact('order', 'packages'));
    }

    public function update(Request $request, Order $order): RedirectResponse
    {
        $validated = $request->validate([
            'adjustment_amount' => 'nullable|numeric',
            'coupon_code' => 'nullable|string|max:50',
            'order_status' => 'required|in:pending,processing,completed,cancelled',
            'payment_status' => 'required|in:pending,completed,failed,refunded',
            'admin_notes' => 'nullable|string',
        ]);

        $adjustment = $validated['adjustment_amount'] ?? 0;
        
        // If package exists, recalculate based on package price + adjustment
        if ($order->package) {
            $basePrice = $order->package->price;
            $newAmount = $basePrice + $adjustment;
        } else {
            // Fallback if no package (shouldn't happen often but safely handle)
            $newAmount = $order->amount + ($adjustment - $order->adjustment_amount); 
        }

        $order->update([
            'amount' => $newAmount,
            'adjustment_amount' => $adjustment,
            'coupon_code' => $validated['coupon_code'],
            'order_status' => $validated['order_status'],
            'payment_status' => $validated['payment_status'],
            'admin_notes' => $validated['admin_notes'],
        ]);

        return redirect()
            ->route('admin.orders.show', $order)
            ->with('success', 'Order updated successfully. New Total: $' . number_format($newAmount, 2));
    }

    public function searchUser(Request $request)
    {
        $search = $request->get('q');
        $users = User::where('email', 'like', "%{$search}%")
            ->orWhere('name', 'like', "%{$search}%")
            ->limit(10)
            ->get(['id', 'name', 'email']);
            
        return response()->json($users);
    }

    public function bulkAction(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'payment_status' => 'nullable|in:pending,completed,failed,refunded',
            'order_status' => 'nullable|in:pending,processing,completed,cancelled',
        ]);

        if (!$request->filled('payment_status') && !$request->filled('order_status')) {
            return redirect()->back()->with('error', 'Please select at least one action to apply.');
        }

        $orders = Order::whereIn('id', $validated['order_ids'])->get();
        $count = 0;

        foreach ($orders as $order) {
            /** @var \App\Models\Order $order */
            $updateData = [];

            if ($request->filled('payment_status')) {
                $updateData['payment_status'] = $validated['payment_status'];
            }

            if ($request->filled('order_status')) {
                if ($validated['order_status'] === 'completed' && !$order->activated_at) {
                    $order->markAsCompleted();
                    $count++;
                    continue;
                }
                $updateData['order_status'] = $validated['order_status'];
            }

            if (!empty($updateData)) {
                $order->update($updateData);
            }
            $count++;
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('success', "Successfully updated {$count} orders.");
    }
}
