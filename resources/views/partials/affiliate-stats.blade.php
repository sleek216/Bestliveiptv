{{-- Affiliate stats cards — used on profile & dashboard --}}
@php
    $commissionRate = $stats['commission_rate'] ?? ($affiliate->getCommissionRate() ?? 20);
@endphp

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 16px; margin-bottom: 28px;">
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Link Clicks</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #fff; margin: 0;">{{ number_format($stats['total_clicks'] ?? 0) }}</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Sign Ups</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #fff; margin: 0;">{{ number_format($stats['total_referrals'] ?? 0) }}</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Package Buyers</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #8b5cf6; margin: 0;">{{ number_format($stats['total_buyers'] ?? 0) }}</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Total Earned</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #10b981; margin: 0;">${{ number_format($stats['total_earnings'] ?? 0, 2) }}</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Pending Approval</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #fbbf24; margin: 0;">${{ number_format($stats['pending_earnings'] ?? 0, 2) }}</p>
        <p style="font-size: 0.7rem; color: rgba(255,255,255,0.45); margin: 6px 0 0;">Waiting for admin</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Approved Balance</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #60a5fa; margin: 0;">${{ number_format($stats['approved_balance'] ?? $stats['available_balance'] ?? 0, 2) }}</p>
        <p style="font-size: 0.7rem; color: rgba(255,255,255,0.45); margin: 6px 0 0;">Admin released</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Paid Out</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #fff; margin: 0;">${{ number_format($stats['total_withdrawn'] ?? 0, 2) }}</p>
        <p style="font-size: 0.7rem; color: rgba(255,255,255,0.45); margin: 6px 0 0;">Withdrawn to you</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Remaining</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #34d399; margin: 0;">${{ number_format($stats['remaining_balance'] ?? 0, 2) }}</p>
        <p style="font-size: 0.7rem; color: rgba(255,255,255,0.45); margin: 6px 0 0;">Available to withdraw</p>
    </div>
    <div class="order-card-glass" style="display: block; padding: 18px;">
        <div style="font-size: 0.75rem; color: var(--text-secondary); text-transform: uppercase; margin-bottom: 8px;">Your Rate</div>
        <p style="font-size: 1.6rem; font-weight: 700; color: #fff; margin: 0;">{{ number_format($commissionRate, 1) }}%</p>
    </div>
</div>

@if(($stats['recent_commissions'] ?? collect())->count() > 0)
<div class="glass-form-card" style="margin-bottom: 24px;">
    <h3 style="font-size: 1.1rem; font-weight: 600; color: #fff; margin-bottom: 16px;">
        <i class="ph-fill ph-shopping-cart"></i> Recent Sales via Your Code
    </h3>
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; font-size: 0.875rem;">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.1); color: rgba(255,255,255,0.6);">
                    <th style="padding: 10px; text-align: left;">Date</th>
                    <th style="padding: 10px; text-align: left;">Buyer</th>
                    <th style="padding: 10px; text-align: left;">Package</th>
                    <th style="padding: 10px; text-align: left;">Order</th>
                    <th style="padding: 10px; text-align: left;">Commission</th>
                    <th style="padding: 10px; text-align: left;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stats['recent_commissions'] as $commission)
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                    <td style="padding: 10px; color: rgba(255,255,255,0.8);">{{ $commission->created_at->format('M d, Y') }}</td>
                    <td style="padding: 10px; color: #fff;">
                        <div>{{ $commission->referral->referredUser->name ?? $commission->order->customer_name ?? '—' }}</div>
                        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.5);">{{ $commission->referral->referredUser->email ?? $commission->order->customer_email ?? '' }}</div>
                    </td>
                    <td style="padding: 10px; color: rgba(255,255,255,0.8);">{{ $commission->order->package->name ?? '—' }}</td>
                    <td style="padding: 10px; color: rgba(255,255,255,0.8);">#{{ $commission->order->order_number ?? $commission->order_id }}</td>
                    <td style="padding: 10px; color: #10b981; font-weight: 600;">
                        <div>${{ number_format($commission->commission_amount, 2) }} <span style="color: rgba(255,255,255,0.5); font-weight: 400;">({{ $commission->commission_rate }}%)</span></div>
                        <div style="font-size: 0.75rem; color: rgba(255,255,255,0.55); font-weight: 400;">
                            Released: ${{ number_format($commission->released_amount, 2) }}
                            @if($commission->remaining_amount > 0)
                                · Remaining: ${{ number_format($commission->remaining_amount, 2) }}
                            @endif
                        </div>
                    </td>
                    <td style="padding: 10px;">
                        @if($commission->status === 'pending')
                            <span style="color: #fbbf24;">Pending approval</span>
                        @elseif($commission->status === 'partial')
                            <span style="color: #60a5fa;">Partially released</span>
                        @elseif($commission->status === 'approved')
                            <span style="color: #10b981;">Fully approved</span>
                        @elseif($commission->status === 'paid')
                            <span style="color: #60a5fa;">Paid out</span>
                        @else
                            <span style="color: #ef4444;">Rejected</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
