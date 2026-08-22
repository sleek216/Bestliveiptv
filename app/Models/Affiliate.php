<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Affiliate extends Model
{
    protected $fillable = [
        'user_id',
        'referral_code',
        'total_earnings',
        'pending_earnings',
        'paid_earnings',
        'total_referrals',
        'total_sales',
        'total_clicks',
        'is_active',
        'custom_commission_rate',
    ];

    protected $casts = [
        'total_earnings' => 'decimal:2',
        'pending_earnings' => 'decimal:2',
        'paid_earnings' => 'decimal:2',
        'custom_commission_rate' => 'decimal:2',
        'total_clicks' => 'integer',
        'is_active' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function referrals(): HasMany
    {
        return $this->hasMany(Referral::class);
    }

    public function commissions(): HasMany
    {
        return $this->hasMany(Commission::class);
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    /** Wallet balance available to withdraw */
    public function getAvailableBalanceAttribute(): float
    {
        return max(0, (float) $this->paid_earnings);
    }

    /** Total amount already paid out to affiliate */
    public function getTotalWithdrawnAttribute(): float
    {
        return (float) $this->payouts()
            ->where('status', 'completed')
            ->get()
            ->sum(fn (Payout $payout) => (float) ($payout->paid_amount ?: $payout->amount));
    }

    /** Amount reserved in pending/processing payout requests */
    public function getReservedBalanceAttribute(): float
    {
        return (float) $this->payouts()
            ->whereIn('status', ['pending', 'processing'])
            ->sum('amount');
    }

    public function getTotalPaidAttribute(): float
    {
        return $this->total_withdrawn;
    }

    public function getPendingBalanceAttribute(): float
    {
        return (float) $this->pending_earnings;
    }

    public function canRequestPayout(): bool
    {
        $minimumPayout = Setting::get('affiliate_minimum_payout', 50);

        return $this->available_balance >= $minimumPayout;
    }

    public static function generateReferralCode(): string
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (self::where('referral_code', $code)->exists());

        return $code;
    }

    /**
     * Get the commission rate for this affiliate
     * Returns custom rate if set, otherwise returns global default
     */
    public function getCommissionRate(): float
    {
        if ($this->custom_commission_rate !== null) {
            return (float) $this->custom_commission_rate;
        }

        return (float) Setting::get('affiliate_commission_rate', 20);
    }
}
