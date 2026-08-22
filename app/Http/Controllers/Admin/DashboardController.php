<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Package;
use App\Models\User;
use App\Models\Contact;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $filter = request('filter', 'all_time');
        $startDate = null;

        switch ($filter) {
            case '7_days':
                $startDate = now()->subDays(7);
                break;
            case '14_days':
                $startDate = now()->subDays(14);
                break;
            case '30_days':
                $startDate = now()->subDays(30);
                break;
            case '1_month':
                $startDate = now()->subMonth();
                break;
            case '2_months':
                $startDate = now()->subMonths(2);
                break;
            case '3_months':
                $startDate = now()->subMonths(3);
                break;
        }

        $statsQuery = Order::paymentCompleted();
        $ordersQuery = Order::query();

        if ($startDate) {
            $statsQuery->where('created_at', '>=', $startDate);
            $ordersQuery->where('created_at', '>=', $startDate);
        }

        $stats = [
            'total_orders' => $ordersQuery->count(),
            'pending_orders' => (clone $ordersQuery)->where('order_status', 'pending')->count(),
            'completed_orders' => (clone $ordersQuery)->where('order_status', 'completed')->count(),
            'total_revenue' => $statsQuery->sum('amount'),
            'total_users' => User::where('is_admin', false)->count(),
            'active_packages' => Package::active()->count(),
            'pending_contacts' => Contact::where('status', 'new')->count(),
        ];

        $recentOrders = Order::with(['user', 'package'])
            ->latest()
            ->take(10)
            ->get();

        $recentUsers = User::where('is_admin', false)
            ->latest()
            ->take(5)
            ->get();

        $monthlyRevenue = Order::paymentCompleted()
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('amount');

        return view('admin.dashboard', compact('stats', 'recentOrders', 'recentUsers', 'monthlyRevenue', 'filter'));
    }
}
