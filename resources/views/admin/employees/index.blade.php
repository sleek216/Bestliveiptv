@extends('admin.layouts.app')

@section('title', 'Employee & Staff Management')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Settings</a></li>
    <li class="breadcrumb-item active">Staff & Employees</li>
@endsection

@section('content')
    <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="page-title">Employee & Staff Management</h1>
            <p class="text-muted mb-0">Control employee access, manage roles, and configure granular permissions</p>
        </div>
        <div>
            <a href="{{ route('admin.employees.create') }}" class="btn btn-primary">
                <i class="bi bi-person-plus-fill me-2"></i>Add New Employee
            </a>
        </div>
    </div>



    <!-- Quick Stats -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-value">{{ $totalEmployees }}</div>
                <div class="stat-label">Total Registered Staff</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card green">
                <div class="stat-value">{{ $activeEmployees }}</div>
                <div class="stat-label">Active Staff Members</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="stat-card orange">
                <div class="stat-value">{{ $totalEmployees - $activeEmployees }}</div>
                <div class="stat-label">Suspended / Inactive</div>
            </div>
        </div>
    </div>

    <!-- Employee Listing Card -->
    <div class="card">
        <div class="card-header bg-white py-3">
            <form action="{{ route('admin.employees.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-4">
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="bi bi-search text-muted"></i></span>
                        <input type="text" name="search" class="form-control border-start-0" placeholder="Search by name, email, or designation..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-md-3">
                    <select name="status" class="form-select" onchange="this.form.submit()">
                        <option value="">All Statuses</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active Staff</option>
                        <option value="inactive" {{ request('status') === 'inactive' ? 'selected' : '' }}>Suspended Staff</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-secondary w-100">Filter</button>
                </div>
                @if(request()->hasAny(['search', 'status']))
                    <div class="col-md-2">
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-link text-decoration-none">Reset Filters</a>
                    </div>
                @endif
            </form>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Employee Details</th>
                            <th>Designation</th>
                            <th>Assigned Permissions</th>
                            <th>Status</th>
                            <th>Last Login</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($employees as $employee)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="user-avatar" style="background: linear-gradient(135deg, #6366f1, #4f46e5); font-weight: bold; width: 40px; height: 40px;">
                                            {{ strtoupper(substr($employee->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="fw-bold text-dark">{{ $employee->name }}</div>
                                            <small class="text-muted"><i class="bi bi-envelope me-1"></i>{{ $employee->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-light text-dark border">
                                        <i class="bi bi-briefcase me-1"></i>{{ $employee->designation ?? 'Staff Member' }}
                                    </span>
                                </td>
                                <td>
                                    @php
                                        $perms = $employee->admin_permissions ?? [];
                                        $count = count($perms);
                                    @endphp
                                    @if($count === 0)
                                        <span class="badge bg-secondary-subtle text-secondary border">No permissions</span>
                                    @else
                                        <div class="d-flex flex-wrap gap-1 align-items-center" style="max-width: 320px;">
                                            @foreach(array_slice($perms, 0, 3) as $p)
                                                <span class="badge bg-primary-subtle text-primary border" style="font-size: 0.72rem;">
                                                    {{ ucfirst(str_replace('_', ' ', $p)) }}
                                                </span>
                                            @endforeach
                                            @if($count > 3)
                                                <span class="badge bg-light text-muted border" title="{{ implode(', ', array_map(fn($k) => ucfirst(str_replace('_', ' ', $k)), $perms)) }}">
                                                    +{{ $count - 3 }} more
                                                </span>
                                            @endif
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    @if($employee->isActive())
                                        <span class="badge bg-success-subtle text-success border border-success-subtle d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-check-circle-fill"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle d-inline-flex align-items-center gap-1">
                                            <i class="bi bi-pause-circle-fill"></i> Suspended
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if($employee->last_login_at)
                                        <small class="text-muted d-block">{{ $employee->last_login_at->format('M d, Y') }}</small>
                                        <small class="text-muted">{{ $employee->last_login_at->format('h:i A') }}</small>
                                    @else
                                        <span class="text-muted small">Never</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-three-dots-vertical"></i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                            <li>
                                                <a class="dropdown-item" href="{{ route('admin.employees.edit', $employee) }}">
                                                    <i class="bi bi-pencil me-2 text-primary"></i>Edit Profile & Permissions
                                                </a>
                                            </li>
                                            <li>
                                                <button class="dropdown-item" type="button" onclick="openResetPasswordModal({{ $employee->id }}, '{{ addslashes($employee->name) }}')">
                                                    <i class="bi bi-key me-2 text-warning"></i>Reset Password
                                                </button>
                                            </li>
                                            <li>
                                                <form action="{{ route('admin.employees.toggle-status', $employee) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        @if($employee->isActive())
                                                            <i class="bi bi-pause-circle me-2 text-secondary"></i>Suspend Employee
                                                        @else
                                                            <i class="bi bi-play-circle me-2 text-success"></i>Activate Employee
                                                        @endif
                                                    </button>
                                                </form>
                                            </li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete employee {{ addslashes($employee->name) }}?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash3 me-2"></i>Delete Employee
                                                    </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="bi bi-people display-6 d-block mb-3 text-secondary opacity-50"></i>
                                    <h5>No staff accounts found</h5>
                                    <p class="small text-muted mb-3">Add employees to delegate responsibilities with controlled permissions.</p>
                                    <a href="{{ route('admin.employees.create') }}" class="btn btn-sm btn-primary">
                                        <i class="bi bi-person-plus me-1"></i>Add First Employee
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($employees->hasPages())
                <div class="card-footer bg-white py-3">
                    {{ $employees->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Password Reset Modal -->
    <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <form id="resetPasswordForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Reset Password: <span id="resetModalEmployeeName" class="text-primary"></span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">New Password *</label>
                            <input type="password" class="form-control" name="password" required minlength="8" placeholder="Minimum 8 characters">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirm New Password *</label>
                            <input type="password" class="form-control" name="password_confirmation" required minlength="8" placeholder="Repeat new password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning"><i class="bi bi-key me-1"></i>Update Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function copyStaffLoginUrl() {
            const copyText = document.getElementById("staffLoginUrlInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value).then(() => {
                const btn = document.getElementById("copyUrlBtn");
                const originalHtml = btn.innerHTML;
                btn.innerHTML = '<i class="bi bi-check-lg me-1"></i>Copied!';
                btn.classList.remove('btn-primary');
                btn.classList.add('btn-success');
                setTimeout(() => {
                    btn.innerHTML = originalHtml;
                    btn.classList.remove('btn-success');
                    btn.classList.add('btn-primary');
                }, 2500);
            });
        }

        function openResetPasswordModal(employeeId, employeeName) {
            document.getElementById('resetModalEmployeeName').innerText = employeeName;
            document.getElementById('resetPasswordForm').action = "{{ url('admin/employees') }}/" + employeeId + "/reset-password";
            new bootstrap.Modal(document.getElementById('resetPasswordModal')).show();
        }
    </script>
    @endpush
@endsection
