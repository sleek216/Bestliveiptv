@extends('admin.layouts.app')

@section('title', 'Orders')

@section('breadcrumb')
    <li class="breadcrumb-item active">Orders</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Orders</h1>
            <p class="text-muted mb-0">Manage customer orders</p>
        </div>
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('admin.export.system-backup') }}" class="btn btn-success">
                <i class="bi bi-download me-1"></i>Export Excel
            </a>
            <a href="{{ route('admin.orders.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Create Order
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="row g-3">
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by order #, name, email..." value="{{ request('search') }}">
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="payment_status" class="form-select">
                        <option value="">All Payment Status</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="completed" {{ request('payment_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-search me-1"></i>Filter
                    </button>
                </div>
            </form>
        </div>
    </div>

    <form id="bulk-action-form" action="{{ route('admin.orders.bulk-action') }}" method="POST">
        @csrf
        
        <!-- Bulk Action Bar (Moved to Top) -->
        <div id="bulk-action-bar" class="card mb-3 bg-light border-primary shadow-sm" style="display: none;">
            <div class="card-body d-flex align-items-center justify-content-between p-3">
                <div class="fw-bold text-primary">
                    <i class="bi bi-check2-all me-2"></i>
                    <span id="selected-count">0</span> orders selected
                </div>
                <div class="d-flex gap-3 align-items-center">
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <span class="input-group-text bg-white">Payment</span>
                        <select name="payment_status" class="form-select">
                            <option value="">No Change</option>
                            <option value="pending">Pending</option>
                            <option value="completed">Completed</option>
                            <option value="failed">Failed</option>
                            <option value="refunded">Refunded</option>
                        </select>
                    </div>
                    <div class="input-group input-group-sm" style="width: 200px;">
                        <span class="input-group-text bg-white">Status</span>
                        <select name="order_status" class="form-select">
                            <option value="">No Change</option>
                            <option value="pending">Pending</option>
                            <option value="processing">Processing</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary d-flex align-items-center">
                        <i class="bi bi-lightning-fill me-1"></i> Apply Bulk Action
                    </button>
                    <button type="button" id="clear-selection" class="btn btn-link text-danger text-decoration-none p-0">Clear</button>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th width="40"><input type="checkbox" id="select-all" class="form-check-input"></th>
                                <th>Order #</th>
                                <th>Customer</th>
                                <th>Package</th>
                                <th>Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Email</th>
                                <th>Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td><input type="checkbox" name="order_ids[]" value="{{ $order->id }}" class="form-check-input order-checkbox"></td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="text-decoration-none fw-medium">
                                            {{ $order->order_number }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="fw-medium">{{ $order->customer_name }}</div>
                                        <small class="text-muted">{{ $order->customer_email }}</small>
                                    </td>
                                    <td>{{ $order->package->name ?? 'N/A' }}</td>
                                    <td><span class="fw-bold">${{ number_format($order->amount, 2) }}</span></td>
                                    <td>
                                        <span class="badge bg-{{ $order->payment_badge }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $order->status_badge }}">
                                            {{ ucfirst($order->order_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        @if($order->email_sent_at)
                                            <span class="text-success" title="Email Sent"><i class="bi bi-check-circle"></i></span>
                                        @else
                                            <span class="text-muted" title="Email Not Sent"><i class="bi bi-x-circle"></i></span>
                                        @endif
                                    </td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="btn-group">
                                            <a href="{{ route('admin.orders.invoice', $order) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="Invoice">
                                                <i class="bi bi-printer"></i>
                                            </a>
                                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary" title="View details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center py-4 text-muted">No orders found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </form>

    <div class="mt-4">
        {{ $orders->withQueryString()->links() }}
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAll = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.order-checkbox');
        const bulkBar = document.getElementById('bulk-action-bar');
        const selectedCount = document.getElementById('selected-count');
        const clearBtn = document.getElementById('clear-selection');

        function updateActionBar() {
            const checkedCount = document.querySelectorAll('.order-checkbox:checked').length;
            selectedCount.textContent = checkedCount;
            bulkBar.style.display = checkedCount > 0 ? 'block' : 'none';
        }

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateActionBar();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', updateActionBar);
        });

        clearBtn.addEventListener('click', function() {
            selectAll.checked = false;
            checkboxes.forEach(cb => cb.checked = false);
            updateActionBar();
        });

        document.getElementById('bulk-action-form').addEventListener('submit', function(e) {
            const payment = this.querySelector('[name="payment_status"]').value;
            const status = this.querySelector('[name="order_status"]').value;
            
            if (!payment && !status) {
                e.preventDefault();
                alert('Please select at least one action (Payment Status or Order Status) to apply.');
            } else if (!confirm('Are you sure you want to apply these changes to the selected orders?')) {
                e.preventDefault();
            }
        });
    });
    </script>
@endsection
