<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Commission extends Model
{
    protected $fillable = [
        'affiliate_id',
        'order_id',
        'referral_id',
        'order_amount',
        'commission_rate',
        'commission_amount',
        'paid_amount',
        'status',
        'approved_at',
        'paid_at',
        'admin_notes',
    ];

    protected $casts = [
        'order_amount' => 'decimal:2',
        'commission_rate' => 'decimal:2',
        'commission_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'approved_at' => 'datetime',
        'paid_at' => 'datetime',
    ];

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function referral(): BelongsTo
    {
        return $this->belongsTo(Referral::class);
    }

    public function getReleasedAmountAttribute(): float
    {
        return (float) ($this->paid_amount ?? 0);
    }

    public function getRemainingAmountAttribute(): float
    {
        if (in_array($this->status, ['rejected', 'paid'], true)) {
            return 0.0;
        }

        return max(0, round((float) $this->commission_amount - $this->released_amount, 2));
    }

    public function canReleasePayment(): bool
    {
        return in_array($this->status, ['pending', 'partial'], true) && $this->remaining_amount > 0;
    }

    public function isFullyReleased(): bool
    {
        return $this->remaining_amount <= 0 && in_array($this->status, ['approved', 'paid'], true);
    }

    public function releasePayment(?float $amount = null): void
    {
        if (! $this->canReleasePayment()) {
            return;
        }

        $remaining = $this->remaining_amount;
        $releaseAmount = $amount ?? $remaining;
        $releaseAmount = max(0, min(round((float) $releaseAmount, 2), $remaining));

        if ($releaseAmount <= 0) {
            return;
        }

        $this->affiliate->decrement('pending_earnings', $releaseAmount);
        $this->affiliate->increment('paid_earnings', $releaseAmount);

        $newPaidTotal = round($this->released_amount + $releaseAmount, 2);
        $isFullyPaid = $newPaidTotal >= round((float) $this->commission_amount, 2);

        $this->update([
            'paid_amount' => $newPaidTotal,
            'status' => $isFullyPaid ? 'approved' : 'partial',
            'approved_at' => $this->approved_at ?? now(),
        ]);
    }

    public function approve(?float $paidAmount = null): void
    {
        $this->releasePayment($paidAmount);
    }

    public function reject(?string $reason = null): void
    {
        if (! in_array($this->status, ['pending', 'partial'], true)) {
            return;
        }

        $released = $this->released_amount;
        $remaining = $this->remaining_amount;

        if ($released > 0) {
            $this->affiliate->decrement('paid_earnings', $released);
        }

        if ($remaining > 0) {
            $this->affiliate->decrement('pending_earnings', $remaining);
        }

        $this->affiliate->decrement('total_earnings', $this->commission_amount);

        $this->update([
            'status' => 'rejected',
            'admin_notes' => $reason,
        ]);
    }

    public function markAsPaid(): void
    {
        if ($this->status === 'approved') {
            $this->update([
                'status' => 'paid',
                'paid_at' => now(),
            ]);
        }
    }
}
