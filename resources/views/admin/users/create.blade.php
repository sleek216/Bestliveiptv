@extends('admin.layouts.app')

@section('title', 'Create User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Users</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
    <div class="mb-4">
        <h1 class="page-title">Create New User</h1>
        <p class="text-muted mb-0">Add a new user to the system</p>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password *</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Minimum 8 characters</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password *</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="country" class="form-label">Country</label>
                                <input type="text" class="form-control @error('country') is-invalid @enderror" id="country" name="country" value="{{ old('country') }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="is_admin" name="is_admin" value="1" {{ old('is_admin') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_admin">Admin Privileges</label>
                        </div>

                        @if(auth()->user()->isSuperAdmin())
                        <div id="admin_permissions_section" class="mb-4 p-3 border rounded bg-light" style="display: none;">
                            <label class="form-label fw-bold mb-3">Admin Permissions</label>
                            <p class="text-muted small mb-3">Select which sections this admin can access.</p>
                            
                            <div class="row">
                                @php
                                    $availablePermissions = [
                                        'packages' => 'Packages',
                                        'orders' => 'Orders',
                                        'users' => 'Users',
                                        'countries' => 'Countries',
                                        'coupons' => 'Coupons',
                                        'contacts' => 'Contacts',
                                        'announcement' => 'Announcement Bar',
                                        'affiliate_overview' => 'Affiliate: Overview',
                                        'affiliate_affiliates' => 'Affiliate: Affiliates',
                                        'affiliate_referrals' => 'Affiliate: Referrals',
                                        'affiliate_commissions' => 'Affiliate: Commissions',
                                        'affiliate_payouts' => 'Affiliate: Payouts',
                                        'affiliate_settings' => 'Affiliate: Settings',
                                        'settings_general' => 'Settings: General',
                                        'settings_stripe' => 'Settings: Stripe',
                                        'settings_nowpayments' => 'Settings: NOWPayments',
                                        'settings_email' => 'Settings: Email',
                                        'settings_security' => 'Settings: Security (2FA)',
                                    ];
                                    $oldPermissions = old('admin_permissions', []);
                                @endphp
                                
                                @foreach($availablePermissions as $key => $label)
                                <div class="col-md-4 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="admin_permissions[]" value="{{ $key }}" id="perm_{{ $key }}" {{ in_array($key, $oldPermissions) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="perm_{{ $key }}">
                                            {{ $label }}
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-plus-lg me-2"></i>Create User
                            </button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const isAdminCheckbox = document.getElementById('is_admin');
            const permissionsSection = document.getElementById('admin_permissions_section');
            
            if (isAdminCheckbox && permissionsSection) {
                const togglePermissions = () => {
                    permissionsSection.style.display = isAdminCheckbox.checked ? 'block' : 'none';
                };
                
                isAdminCheckbox.addEventListener('change', togglePermissions);
                togglePermissions(); // initial state
            }
        });
    </script>
    @endpush
@endsection
