@extends('admin.layouts.app')

@section('title', 'Referred Users')

@section('content')
<div class="container-fluid p-0 referred-users-page">
    <div class="d-flex flex-wrap justify-content-between align-items-start gap-3 mb-4">
        <div>
            <h1 class="h3 mb-1 fw-bold text-dark">Referred Users</h1>
            <p class="text-muted mb-0">Track sign-ups from referral links and release commission to referrers</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden">
        <div class="table-responsive">
            <table class="table referred-users-table align-middle mb-0">
                <thead>
                    <tr>
                        <th class="ps-4">User &amp; Referrer</th>
                        <th>Referral</th>
                        <th>Purchase</th>
                        <th>Commission</th>
                        <th>Status</th>
                        <th class="pe-4 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($referrals as $referral)
                    @php
                        $affiliate = $referral->affiliate;
                        $commission = $referral->commissions->sortByDesc('created_at')->first();
                        $rate = $affiliate?->getCommissionRate() ?? $defaultRate;
                        $progress = $commission && $commission->commission_amount > 0
                            ? min(100, round(($commission->released_amount / $commission->commission_amount) * 100))
                            : 0;
                    @endphp
                    <tr>
                        <td class="ps-4">
                            <div class="ru-user-block">
                                <div class="ru-user-row">
                                    <div class="ru-avatar ru-avatar-buyer">{{ strtoupper(substr($referral->referredUser->name ?? 'U', 0, 1)) }}</div>
                                    <div>
                                        <div class="ru-label">Referred user</div>
                                        <div class="ru-name">{{ $referral->referredUser->name ?? 'Unknown' }}</div>
                                        <div class="ru-email">{{ $referral->referredUser->email ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="ru-arrow"><i class="bi bi-arrow-down-short"></i></div>
                                <div class="ru-user-row">
                                    <div class="ru-avatar ru-avatar-referrer">{{ strtoupper(substr($affiliate->user->name ?? 'A', 0, 1)) }}</div>
                                    <div>
                                        <div class="ru-label">Referred by</div>
                                        <div class="ru-name">{{ $affiliate->user->name ?? 'Unknown' }}</div>
                                        <div class="ru-email text-muted">{{ $affiliate->user->email ?? '—' }}</div>
                                    </div>
                                </div>
                                <div class="ru-joined">
                                    <i class="bi bi-calendar3 me-1"></i>{{ $referral->created_at->format('M d, Y · h:i A') }}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="ru-meta-stack">
                                <span class="ru-code">{{ $referral->referral_code }}</span>
                                <span class="ru-rate">{{ $affiliate?->custom_commission_rate ? number_format($affiliate->custom_commission_rate, 1) : $defaultRate }}% commission</span>
                            </div>
                        </td>
                        <td>
                            @if($referral->converted_at && $commission?->order)
                                <div class="ru-purchase">
                                    <div class="ru-purchase-title">{{ $commission->order->package->name ?? 'Package' }}</div>
                                    <div class="ru-purchase-price">${{ number_format($commission->order_amount, 2) }}</div>
                                    <span class="ru-pill ru-pill-success">Purchased</span>
                                </div>
                            @else
                                <span class="ru-pill ru-pill-warning">Signed up only</span>
                            @endif
                        </td>
                        <td>
                            @if($commission)
                                <div class="ru-commission">
                                    <div class="ru-commission-top">
                                        <span class="ru-commission-total">${{ number_format($commission->commission_amount, 2) }}</span>
                                        <span class="ru-commission-sub">total</span>
                                    </div>
                                    <div class="ru-progress">
                                        <div class="ru-progress-bar" style="width: {{ $progress }}%"></div>
                                    </div>
                                    <div class="ru-commission-stats">
                                        <span class="text-success"><strong>${{ number_format($commission->released_amount, 2) }}</strong> released</span>
                                        <span class="text-muted">·</span>
                                        <span class="{{ $commission->remaining_amount > 0 ? 'text-warning' : 'text-muted' }}">
                                            <strong>${{ number_format($commission->remaining_amount, 2) }}</strong> left
                                        </span>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($commission)
                                @if($commission->status === 'pending')
                                    <span class="ru-status ru-status-pending"><i class="bi bi-hourglass-split"></i> Pending</span>
                                @elseif($commission->status === 'partial')
                                    <span class="ru-status ru-status-partial"><i class="bi bi-pie-chart"></i> Partial</span>
                                @elseif($commission->status === 'approved')
                                    <span class="ru-status ru-status-done"><i class="bi bi-check-circle"></i> Complete</span>
                                @elseif($commission->status === 'paid')
                                    <span class="ru-status ru-status-paid"><i class="bi bi-wallet2"></i> Paid out</span>
                                @else
                                    <span class="ru-status ru-status-rejected"><i class="bi bi-x-circle"></i> Rejected</span>
                                @endif
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            @if($commission && $commission->canReleasePayment())
                                <div class="ru-actions">
                                    <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="bi bi-check2-circle me-1"></i>
                                            {{ $commission->status === 'partial' ? 'Release $'.number_format($commission->remaining_amount, 2) : 'Approve' }}
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#payModal{{ $commission->id }}">
                                        <i class="bi bi-cash-coin me-1"></i>Custom
                                    </button>
                                    @if($commission->status === 'pending')
                                    <form action="{{ route('admin.affiliate.commissions.reject', $commission) }}" method="POST" onsubmit="return confirm('Reject this commission?')">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Reject">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>

                                <div class="modal fade" id="payModal{{ $commission->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content border-0 shadow">
                                            <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-bold">Release Commission</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="ru-modal-summary mb-4">
                                                        <div><span class="text-muted">Referrer</span><br><strong>{{ $affiliate->user->email }}</strong></div>
                                                        <div><span class="text-muted">Buyer</span><br><strong>{{ $referral->referredUser->email }}</strong></div>
                                                    </div>
                                                    <div class="row g-2 mb-4">
                                                        <div class="col-4">
                                                            <div class="ru-modal-stat">
                                                                <div class="ru-modal-stat-label">Total</div>
                                                                <div class="ru-modal-stat-value">${{ number_format($commission->commission_amount, 2) }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="ru-modal-stat">
                                                                <div class="ru-modal-stat-label">Released</div>
                                                                <div class="ru-modal-stat-value text-success">${{ number_format($commission->released_amount, 2) }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="ru-modal-stat">
                                                                <div class="ru-modal-stat-label">Remaining</div>
                                                                <div class="ru-modal-stat-value text-warning">${{ number_format($commission->remaining_amount, 2) }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <label class="form-label fw-semibold">Amount to release now</label>
                                                    <div class="input-group input-group-lg">
                                                        <span class="input-group-text">$</span>
                                                        <input type="number" name="paid_amount" class="form-control" step="0.01" min="0.01" max="{{ $commission->remaining_amount }}" value="{{ $commission->remaining_amount }}" required>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                    <button type="submit" class="btn btn-primary">Release Payment</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @elseif($affiliate)
                                <button type="button" class="btn btn-sm btn-light border" data-bs-toggle="modal" data-bs-target="#rateModal{{ $affiliate->id }}">
                                    <i class="bi bi-percent me-1"></i>Rate
                                </button>

                                <div class="modal fade" id="rateModal{{ $affiliate->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-sm">
                                        <div class="modal-content border-0 shadow">
                                            <form action="{{ route('admin.affiliate.affiliates.commission-rate', $affiliate) }}" method="POST">
                                                @csrf
                                                <div class="modal-header border-0 pb-0">
                                                    <h5 class="modal-title fw-bold">Commission Rate</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="small text-muted mb-3">{{ $affiliate->user->email }}</p>
                                                    <label class="form-label">Custom rate %</label>
                                                    <input type="number" name="custom_commission_rate" class="form-control" step="0.1" min="0" max="100" value="{{ $affiliate->custom_commission_rate }}" placeholder="Default {{ $defaultRate }}%">
                                                    <div class="form-text">Leave empty to use global default ({{ $defaultRate }}%)</div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="submit" class="btn btn-primary btn-sm">Save Rate</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="ru-empty">
                                <i class="bi bi-people"></i>
                                <p>No referred users yet</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($referrals->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $referrals->links() }}
        </div>
        @endif
    </div>
</div>

<style>
.referred-users-page .referred-users-table thead th {
    background: #f8fafc;
    color: #64748b;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    border-bottom: 1px solid #e2e8f0;
    padding: 0.9rem 0.75rem;
    white-space: nowrap;
}

.referred-users-page .referred-users-table tbody td {
    padding: 1.1rem 0.75rem;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}

.referred-users-page .referred-users-table tbody tr:hover {
    background: #fafbfc;
}

.ru-user-block {
    min-width: 240px;
}

.ru-user-row {
    display: flex;
    align-items: center;
    gap: 0.65rem;
}

.ru-avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.85rem;
    flex-shrink: 0;
}

.ru-avatar-buyer {
    background: #ede9fe;
    color: #6d28d9;
}

.ru-avatar-referrer {
    background: #dbeafe;
    color: #1d4ed8;
}

.ru-label {
    font-size: 0.65rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: #94a3b8;
    font-weight: 600;
    line-height: 1.2;
}

.ru-name {
    font-weight: 600;
    color: #0f172a;
    font-size: 0.9rem;
    line-height: 1.3;
}

.ru-email {
    font-size: 0.8rem;
    color: #6366f1;
    line-height: 1.3;
}

.ru-arrow {
    color: #cbd5e1;
    text-align: center;
    line-height: 1;
    margin: 0.15rem 0 0.15rem 10px;
    font-size: 1.1rem;
}

.ru-joined {
    margin-top: 0.5rem;
    font-size: 0.75rem;
    color: #94a3b8;
}

.ru-meta-stack {
    display: flex;
    flex-direction: column;
    gap: 0.35rem;
}

.ru-code {
    display: inline-block;
    font-family: ui-monospace, monospace;
    font-size: 0.8rem;
    font-weight: 600;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    color: #334155;
    padding: 0.35rem 0.55rem;
    border-radius: 8px;
    width: fit-content;
}

.ru-rate {
    font-size: 0.8rem;
    color: #64748b;
}

.ru-purchase-title {
    font-weight: 600;
    color: #0f172a;
    font-size: 0.875rem;
}

.ru-purchase-price {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 0.35rem;
}

.ru-pill {
    display: inline-block;
    font-size: 0.7rem;
    font-weight: 600;
    padding: 0.25rem 0.55rem;
    border-radius: 999px;
}

.ru-pill-success {
    background: #dcfce7;
    color: #15803d;
}

.ru-pill-warning {
    background: #fef3c7;
    color: #b45309;
}

.ru-commission {
    min-width: 150px;
}

.ru-commission-top {
    display: flex;
    align-items: baseline;
    gap: 0.35rem;
    margin-bottom: 0.4rem;
}

.ru-commission-total {
    font-size: 1.1rem;
    font-weight: 700;
    color: #0f172a;
}

.ru-commission-sub {
    font-size: 0.75rem;
    color: #94a3b8;
}

.ru-progress {
    height: 6px;
    background: #e2e8f0;
    border-radius: 999px;
    overflow: hidden;
    margin-bottom: 0.4rem;
}

.ru-progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #22c55e, #16a34a);
    border-radius: 999px;
    transition: width 0.3s ease;
}

.ru-commission-stats {
    font-size: 0.75rem;
    display: flex;
    flex-wrap: wrap;
    gap: 0.25rem;
    align-items: center;
}

.ru-status {
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    font-size: 0.78rem;
    font-weight: 600;
    padding: 0.4rem 0.7rem;
    border-radius: 999px;
    white-space: nowrap;
}

.ru-status-pending { background: #fef3c7; color: #b45309; }
.ru-status-partial { background: #e0f2fe; color: #0369a1; }
.ru-status-done { background: #dcfce7; color: #15803d; }
.ru-status-paid { background: #ede9fe; color: #6d28d9; }
.ru-status-rejected { background: #fee2e2; color: #b91c1c; }

.ru-actions {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    gap: 0.35rem;
    flex-wrap: wrap;
}

.ru-modal-summary {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
    font-size: 0.9rem;
}

.ru-modal-stat {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 0.75rem;
    text-align: center;
}

.ru-modal-stat-label {
    font-size: 0.7rem;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: #94a3b8;
    margin-bottom: 0.25rem;
}

.ru-modal-stat-value {
    font-size: 1rem;
    font-weight: 700;
    color: #0f172a;
}

.ru-empty {
    color: #94a3b8;
    padding: 2rem 0;
}

.ru-empty i {
    font-size: 2.5rem;
    display: block;
    margin-bottom: 0.75rem;
    opacity: 0.35;
}

@media (max-width: 1200px) {
    .referred-users-page .table-responsive {
        overflow-x: auto;
    }
    .referred-users-page .referred-users-table {
        min-width: 980px;
    }
}
</style>
@endsection
