<?php

namespace App\Services;

use App\Models\User;
use App\Models\Affiliate;
use App\Models\Referral;
use App\Models\Commission;
use App\Models\Order;
use App\Models\Setting;
use Illuminate\Support\Facades\Cookie;

class AffiliateService
{
    /**
     * Track referral from cookie or URL parameter
     */
    public function trackReferral(?string $referralCode, User $user): ?Referral
    {
        if (!$referralCode) {
            return null;
        }

        $affiliate = Affiliate::where('referral_code', $referralCode)
            ->where('is_active', true)
            ->first();

        if (!$affiliate || $affiliate->user_id === $user->id) {
            return null;
        }

        // Check if already referred
        if ($user->referred_by) {
            return null;
        }

        // Create referral record
        $referral = Referral::create([
            'affiliate_id' => $affiliate->id,
            'referred_user_id' => $user->id,
            'referral_code' => $referralCode,
            'ip_address' => request()->ip(),
        ]);

        // Update user
        $user->update(['referred_by' => $affiliate->user_id]);

        // Update affiliate stats
        $affiliate->increment('total_referrals');

        return $referral;
    }

    /**
     * Create commission for an order
     */
    public function createCommission(Order $order): ?Commission
    {
        // Check if affiliate system is enabled
        if (!Setting::get('affiliate_enabled', true)) {
            return null;
        }

        // Check if user was referred
        if (!$order->user->referred_by) {
            return null;
        }

        $affiliate = Affiliate::where('user_id', $order->user->referred_by)
            ->where('is_active', true)
            ->first();

        if (!$affiliate) {
            return null;
        }

        $referral = Referral::where('affiliate_id', $affiliate->id)
            ->where('referred_user_id', $order->user_id)
            ->first();

        if (!$referral) {
            return null;
        }

        // Mark referral as converted
        $referral->markAsConverted();

        // Get commission rate (custom or default)
        $commissionRate = $affiliate->getCommissionRate();
        $commissionAmount = ($order->amount * $commissionRate) / 100;

        // Create commission
        $commission = Commission::create([
            'affiliate_id' => $affiliate->id,
            'order_id' => $order->id,
            'referral_id' => $referral->id,
            'order_amount' => $order->amount,
            'commission_rate' => $commissionRate,
            'commission_amount' => $commissionAmount,
            'status' => 'pending',
        ]);

        // Update affiliate stats
        $affiliate->increment('total_sales');
        $affiliate->increment('pending_earnings', $commissionAmount);
        $affiliate->increment('total_earnings', $commissionAmount);

        return $commission;
    }

    /**
     * Set referral cookie
     */
    public function setReferralCookie(string $referralCode): void
    {
        $duration = Setting::get('affiliate_cookie_duration', 30);
        Cookie::queue('referral_code', $referralCode, $duration * 24 * 60);
    }

    /**
     * Get referral code from cookie or request
     */
    public function getReferralCode(): ?string
    {
        return request()->query('ref') ?? Cookie::get('referral_code');
    }

    /**
     * Get affiliate statistics
     */
    public function getAffiliateStats(Affiliate $affiliate): array
    {
        $totalClicks = (int) ($affiliate->total_clicks ?? 0);

        return [
            'total_clicks' => $totalClicks,
            'total_referrals' => $affiliate->total_referrals,
            'total_buyers' => $affiliate->total_sales,
            'total_sales' => $affiliate->total_sales,
            'total_earnings' => $affiliate->total_earnings,
            'pending_earnings' => $affiliate->pending_earnings,
            'approved_balance' => $affiliate->paid_earnings,
            'available_balance' => $affiliate->available_balance,
            'total_withdrawn' => $affiliate->total_withdrawn,
            'remaining_balance' => $affiliate->available_balance,
            'reserved_balance' => $affiliate->reserved_balance,
            'commission_rate' => $affiliate->getCommissionRate(),
            'conversion_rate' => $totalClicks > 0
                ? round(($affiliate->total_referrals / $totalClicks) * 100, 2)
                : 0,
            'recent_referrals' => $affiliate->referrals()
                ->with('referredUser')
                ->latest()
                ->take(10)
                ->get(),
            'recent_commissions' => $affiliate->commissions()
                ->with(['order.package', 'referral.referredUser'])
                ->latest()
                ->take(10)
                ->get(),
        ];
    }

    /**
     * Request payout — reserves amount from affiliate wallet
     */
    public function requestPayout(Affiliate $affiliate, array $data): ?\App\Models\Payout
    {
        $amount = (float) $data['amount'];

        if (!$affiliate->canRequestPayout() || $amount > $affiliate->paid_earnings) {
            return null;
        }

        $affiliate->decrement('paid_earnings', $amount);

        return \App\Models\Payout::create([
            'affiliate_id' => $affiliate->id,
            'amount' => $amount,
            'payment_method' => $data['payment_method'],
            'payment_details' => $data['payment_details'],
            'status' => 'pending',
        ]);
    }

    /**
     * Update pending commission rate/amount before admin approval
     */
    public function updateCommissionRate(Commission $commission, float $rate): Commission
    {
        if ($commission->status !== 'pending' || $commission->released_amount > 0) {
            return $commission;
        }

        $newAmount = round(((float) $commission->order_amount * $rate) / 100, 2);
        $difference = $newAmount - (float) $commission->commission_amount;

        $commission->affiliate->increment('pending_earnings', $difference);
        $commission->affiliate->increment('total_earnings', $difference);

        $commission->update([
            'commission_rate' => $rate,
            'commission_amount' => $newAmount,
        ]);

        return $commission->fresh();
    }
}
