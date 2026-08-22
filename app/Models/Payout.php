<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payout extends Model
{
    protected $fillable = [
        'affiliate_id',
        'amount',
        'paid_amount',
        'payment_method',
        'payment_details',
        'status',
        'processed_at',
        'admin_notes',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'payment_details' => 'array',
        'processed_at' => 'datetime',
    ];

    public function affiliate(): BelongsTo
    {
        return $this->belongsTo(Affiliate::class);
    }

    public function approve(): void
    {
        if ($this->status === 'pending') {
            $this->update([
                'status' => 'processing',
            ]);
        }
    }

    public function complete($paidAmount = null): void
    {
        if (!in_array($this->status, ['processing', 'pending'], true)) {
            return;
        }

        $paidAmount = (float) ($paidAmount ?? $this->amount);

        $this->update([
            'status' => 'completed',
            'paid_amount' => $paidAmount,
            'processed_at' => now(),
        ]);

        // If admin pays less than requested, return the difference to wallet
        if ($paidAmount < $this->amount) {
            $this->affiliate->increment('paid_earnings', $this->amount - $paidAmount);
        }
    }

    public function reject(string $reason = null): void
    {
        if (!in_array($this->status, ['pending', 'processing'], true)) {
            return;
        }

        $this->update([
            'status' => 'rejected',
            'admin_notes' => $reason,
            'processed_at' => now(),
        ]);

        // Return reserved funds to affiliate wallet
        $this->affiliate->increment('paid_earnings', $this->amount);
    }
}
