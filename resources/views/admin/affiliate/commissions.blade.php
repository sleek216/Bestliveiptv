@extends('admin.layouts.app')

@section('title', 'Manage Commissions')

@section('content')
<div class="container-fluid p-0">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-1 text-gray-800">Commissions</h1>
            <p class="text-muted mb-0">Review sales via referral codes — set commission % then approve</p>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 text-uppercase text-muted small fw-bold">Date</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Affiliate / Code</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Buyer & Package</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Order</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Commission</th>
                        <th class="py-3 text-uppercase text-muted small fw-bold">Status</th>
                        <th class="pe-4 py-3 text-uppercase text-muted small fw-bold text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($commissions as $commission)
                    <tr>
                        <td class="ps-4">
                            <div class="fw-bold text-dark">{{ $commission->created_at->format('M d, Y') }}</div>
                            <div class="small text-muted">{{ $commission->created_at->format('h:i A') }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $commission->affiliate->user->name ?? 'Unknown' }}</div>
                            <div class="small text-muted">{{ $commission->affiliate->user->email ?? '' }}</div>
                            <span class="badge bg-light text-dark border font-monospace mt-1">{{ $commission->affiliate->referral_code ?? $commission->referral->referral_code ?? '—' }}</span>
                        </td>
                        <td>
                            <div class="fw-bold text-dark">{{ $commission->referral->referredUser->name ?? $commission->order->customer_name ?? 'Unknown' }}</div>
                            <div class="small text-muted">{{ $commission->referral->referredUser->email ?? $commission->order->customer_email ?? '' }}</div>
                            <div class="small text-primary mt-1">{{ $commission->order->package->name ?? 'Package' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border font-monospace">#{{ $commission->order->order_number ?? $commission->order_id }}</span>
                            <div class="small text-muted mt-1">${{ number_format($commission->order_amount, 2) }}</div>
                        </td>
                        <td>
                            <div class="fw-bold text-success">${{ number_format($commission->commission_amount, 2) }}</div>
                            <div class="small text-muted">Released: ${{ number_format($commission->released_amount, 2) }}</div>
                            @if($commission->remaining_amount > 0)
                                <div class="small text-warning">Remaining: ${{ number_format($commission->remaining_amount, 2) }}</div>
                            @endif
                            <div class="small text-muted">{{ $commission->commission_rate }}% rate</div>
                        </td>
                        <td>
                            @if($commission->status === 'paid')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Paid</span>
                            @elseif($commission->status === 'approved')
                                <span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3 py-2">Fully Approved</span>
                            @elseif($commission->status === 'partial')
                                <span class="badge bg-info bg-opacity-10 text-info rounded-pill px-3 py-2">Partial</span>
                            @elseif($commission->status === 'pending')
                                <span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3 py-2">Pending</span>
                            @else
                                <span class="badge bg-danger bg-opacity-10 text-danger rounded-pill px-3 py-2">Rejected</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            @if($commission->canReleasePayment())
                                <div class="d-flex justify-content-end align-items-center gap-2 flex-wrap">
                                    @if($commission->status === 'pending')
                                    <form action="{{ route('admin.affiliate.commissions.update', $commission) }}" method="POST" class="d-flex align-items-center gap-1">
                                        @csrf
                                        <input type="number" name="commission_rate" class="form-control form-control-sm" style="width: 70px;" step="0.1" min="0" max="100" value="{{ $commission->commission_rate }}" required>
                                        <button type="submit" class="btn btn-sm btn-outline-secondary" title="Save rate">%</button>
                                    </form>
                                    @endif
                                    <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success text-white" title="Release remaining">
                                            <i class="bi bi-check-lg"></i>
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#commissionPayModal{{ $commission->id }}">Custom</button>
                                    @if($commission->status === 'pending')
                                    <form action="{{ route('admin.affiliate.commissions.reject', $commission) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-danger text-white" title="Reject">
                                            <i class="bi bi-x-lg"></i>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                                <div class="modal fade" id="commissionPayModal{{ $commission->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <form action="{{ route('admin.affiliate.commissions.approve', $commission) }}" method="POST">
                                                @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Release Amount</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="small text-muted mb-2">Remaining: ${{ number_format($commission->remaining_amount, 2) }}</div>
                                                    <input type="number" name="paid_amount" class="form-control" step="0.01" min="0.01" max="{{ $commission->remaining_amount }}" value="{{ $commission->remaining_amount }}" required>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary btn-sm">Release</button>
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
                        <td colspan="7" class="text-center py-5 text-muted">
                            <i class="bi bi-cash-stack display-4 d-block mb-3 opacity-25"></i>
                            <p class="mb-0">No commissions found</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($commissions->hasPages())
        <div class="card-footer bg-white border-top-0 py-3">
            {{ $commissions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
