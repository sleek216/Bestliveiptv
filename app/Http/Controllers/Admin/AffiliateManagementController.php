<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Affiliate;
use App\Models\Commission;
use App\Models\Payout;
use App\Models\Setting;
use App\Services\AffiliateService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AffiliateManagementController extends Controller
{
    public function __construct(protected AffiliateService $affiliateService)
    {
    }

    // Routes already have 'admin' middleware, no need to add here

    /**
     * Show affiliate overview
     */
    public function index(): View
    {
        $stats = [
            'total_affiliates' => Affiliate::count(),
            'active_affiliates' => Affiliate::where('is_active', true)->count(),
            'total_referrals' => Affiliate::sum('total_referrals'),
            'total_sales' => Affiliate::sum('total_sales'),
            'total_earnings' => Affiliate::sum('total_earnings'),
            'pending_earnings' => Affiliate::sum('pending_earnings'),
            'paid_earnings' => Affiliate::sum('paid_earnings'),
            'pending_commissions' => Commission::where('status', 'pending')->count(),
            'pending_payouts' => Payout::where('status', 'pending')->count(),
        ];

        $topAffiliates = Affiliate::with('user')
            ->orderBy('total_earnings', 'desc')
            ->take(10)
            ->get();

        return view('admin.affiliate.index', compact('stats', 'topAffiliates'));
    }

    /**
     * Show overview of all referrals
     */
    public function referrals(): View
    {
        $referrals = \App\Models\Referral::with(['affiliate.user', 'referredUser', 'commissions'])
            ->latest()
            ->paginate(20);

        return view('admin.affiliate.referrals', compact('referrals'));
    }

    /**
     * Referred users who joined via an affiliate link
     */
    public function affiliates(): View
    {
        $referrals = \App\Models\Referral::with([
            'affiliate.user',
            'referredUser',
            'commissions.order.package',
        ])
            ->latest()
            ->paginate(20);

        $defaultRate = Setting::get('affiliate_commission_rate', 20);

        return view('admin.affiliate.affiliates', compact('referrals', 'defaultRate'));
    }



    /**
     * Show pending commissions
     */
    public function commissions(): View
    {
        $commissions = Commission::with(['affiliate.user', 'order.package', 'referral.referredUser'])
            ->latest()
            ->paginate(20);

        $defaultRate = Setting::get('affiliate_commission_rate', 20);

        return view('admin.affiliate.commissions', compact('commissions', 'defaultRate'));
    }

    /**
     * Adjust commission rate before approval
     */
    public function updateCommission(Request $request, Commission $commission): RedirectResponse
    {
        $validated = $request->validate([
            'commission_rate' => 'required|numeric|min:0|max:100',
        ]);

        if ($commission->status !== 'pending' || $commission->released_amount > 0) {
            return back()->with('error', 'Only unpaid pending commissions can be updated.');
        }

        $this->affiliateService->updateCommissionRate($commission, (float) $validated['commission_rate']);

        return back()->with('success', 'Commission rate updated successfully.');
    }

    /**
     * Approve commission (full or custom amount)
     */
    public function approveCommission(Request $request, Commission $commission): RedirectResponse
    {
        if (! $commission->canReleasePayment()) {
            return back()->with('error', 'No remaining commission available to release.');
        }

        $validated = $request->validate([
            'paid_amount' => 'nullable|numeric|min:0.01|max:' . $commission->remaining_amount,
        ]);

        $releaseAmount = isset($validated['paid_amount'])
            ? (float) $validated['paid_amount']
            : $commission->remaining_amount;

        $commission->releasePayment($releaseAmount);
        $commission->refresh();

        $message = '$' . number_format($releaseAmount, 2) . ' released to affiliate wallet.';

        if ($commission->remaining_amount > 0) {
            $message .= ' Remaining: $' . number_format($commission->remaining_amount, 2) . '.';
        } else {
            $message .= ' Commission fully approved.';
        }

        return back()->with('success', $message);
    }

    /**
     * Reject commission
     */
    public function rejectCommission(Request $request, Commission $commission): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $commission->reject($validated['reason'] ?? null);

        return back()->with('success', 'Commission rejected.');
    }

    /**
     * Show payouts
     */
    public function payouts(): View
    {
        $payouts = Payout::with('affiliate.user')
            ->latest()
            ->paginate(20);

        return view('admin.affiliate.payouts', compact('payouts'));
    }

    /**
     * Approve payout
     */
    public function approvePayout(Payout $payout): RedirectResponse
    {
        $payout->approve();

        return back()->with('success', 'Payout approved and set to processing.');
    }

    public function completePayout(Request $request, Payout $payout): RedirectResponse
    {
        $validated = $request->validate([
            'paid_amount' => 'nullable|numeric|min:0|max:' . $payout->amount,
        ]);

        $paidAmount = $validated['paid_amount'] ?? $payout->amount;
        $payout->complete($paidAmount);

        return back()->with('success', 'Payout marked as completed with actual amount $' . number_format($paidAmount, 2) . '!');
    }

    /**
     * Reject payout
     */
    public function rejectPayout(Request $request, Payout $payout): RedirectResponse
    {
        $validated = $request->validate([
            'reason' => 'nullable|string|max:500',
        ]);

        $payout->reject($validated['reason'] ?? null);

        return back()->with('success', 'Payout rejected.');
    }

    /**
     * Show affiliate settings
     */
    public function settings(): View
    {
        return view('admin.affiliate.settings');
    }

    /**
     * Update affiliate settings
     */
    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'affiliate_enabled' => 'required|boolean',
            'affiliate_commission_rate' => 'required|numeric|min:0|max:100',
            'affiliate_minimum_payout' => 'required|numeric|min:0',
            'affiliate_cookie_duration' => 'required|integer|min:1|max:365',
        ]);

        foreach ($validated as $key => $value) {
            Setting::set($key, $value, 'text', 'affiliate');
        }

        \Cache::flush();

        return back()->with('success', 'Affiliate settings updated successfully!');
    }

    /**
     * Toggle affiliate status
     */
    public function toggleStatus(Affiliate $affiliate): RedirectResponse
    {
        $affiliate->update(['is_active' => !$affiliate->is_active]);

        $status = $affiliate->is_active ? 'activated' : 'deactivated';
        
        return back()->with('success', "Affiliate {$status} successfully!");
    }

    /**
     * Set custom commission rate for an affiliate
     */
    public function updateAffiliateCommissionRate(Request $request, Affiliate $affiliate): RedirectResponse
    {
        $validated = $request->validate([
            'custom_commission_rate' => 'nullable|numeric|min:0|max:100',
        ]);

        $affiliate->update([
            'custom_commission_rate' => $validated['custom_commission_rate'],
        ]);

        $message = $validated['custom_commission_rate']
            ? "Commission rate set to {$validated['custom_commission_rate']}% for {$affiliate->user->name}"
            : "Commission rate reset to default for {$affiliate->user->name}";

        return back()->with('success', $message);
    }
}
