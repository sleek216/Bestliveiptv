@extends('admin.layouts.app')

@section('title', 'Add New Employee')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Settings</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.employees.index') }}">Staff & Employees</a></li>
    <li class="breadcrumb-item active">Add New</li>
@endsection

@section('content')
    <div class="mb-4 d-flex flex-wrap justify-content-between align-items-center gap-3">
        <div>
            <h1 class="page-title">Add New Employee</h1>
            <p class="text-muted mb-0">Create employee credentials and select their accessible sections and features</p>
        </div>
        <div>
            <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-left me-1"></i>Back to Staff List
            </a>
        </div>
    </div>

    <form action="{{ route('admin.employees.store') }}" method="POST">
        @csrf

        <div class="row g-4">
            <!-- Left Column: Personal & Credentials Information -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3">
                        <i class="bi bi-person-badge me-2 text-primary"></i>Employee Account Information
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name *</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="e.g. John Doe" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Work Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="employee@bestliveiptv.com" required>
                            <small class="text-muted">This email will be used to log in at the Staff Portal.</small>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="designation" class="form-label">Designation / Role Title</label>
                            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation" name="designation" value="{{ old('designation', 'Customer Support') }}" placeholder="e.g. Support Specialist, Sales Manager">
                            @error('designation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number (Optional)</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+123456789">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="mb-3">
                            <label for="password" class="form-label">Password *</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required minlength="8" placeholder="Minimum 8 characters">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password *</label>
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required minlength="8" placeholder="Repeat password">
                        </div>

                        <div class="form-check form-switch mt-4 mb-2">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', '1') ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">Account Active</label>
                            <small class="d-block text-muted">Inactive employees cannot log in to the system.</small>
                        </div>
                    </div>
                </div>

                <div class="card bg-light border-0">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100 py-2 mb-2 fw-semibold">
                            <i class="bi bi-check-lg me-1"></i>Create Employee
                        </button>
                        <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-secondary w-100">Cancel</a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Granular Permissions Checklist -->
            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-header bg-white py-3 d-flex flex-wrap justify-content-between align-items-center gap-2">
                        <div>
                            <span class="fw-bold"><i class="bi bi-shield-check me-2 text-primary"></i>Granular Permissions Matrix</span>
                            <small class="text-muted d-block">Check each specific feature and section this employee is permitted to access</small>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="toggleAllPermissions(true)">
                                <i class="bi bi-check-all me-1"></i>Select All
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="toggleAllPermissions(false)">
                                <i class="bi bi-dash me-1"></i>Deselect All
                            </button>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        @php
                            $oldPerms = old('permissions', []);
                        @endphp

                        @foreach($permissionGroups as $groupName => $permissions)
                            <div class="permission-category-box mb-4 p-3 border rounded-3 bg-white shadow-sm">
                                <div class="d-flex justify-content-between align-items-center mb-3 pb-2 border-bottom">
                                    <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                        <span>{{ $groupName }}</span>
                                        <span class="badge bg-light text-secondary border">{{ count($permissions) }} features</span>
                                    </h6>
                                    <button type="button" class="btn btn-link btn-sm text-decoration-none p-0" onclick="toggleGroupPermissions('{{ Str::slug($groupName) }}')">
                                        <i class="bi bi-check2-square me-1"></i>Toggle Group
                                    </button>
                                </div>

                                <div class="row g-3">
                                    @foreach($permissions as $permKey => $permMeta)
                                        <div class="col-md-6">
                                            <div class="p-3 border rounded-3 h-100 perm-item-card transition-all" style="background: #f8fafc;">
                                                <div class="form-check">
                                                    <input class="form-check-input perm-checkbox group-{{ Str::slug($groupName) }}" type="checkbox" name="permissions[]" value="{{ $permKey }}" id="perm_{{ $permKey }}" {{ in_array($permKey, $oldPerms) ? 'checked' : '' }}>
                                                    <label class="form-check-label fw-bold text-dark d-flex align-items-center gap-2" for="perm_{{ $permKey }}">
                                                        <i class="bi {{ $permMeta['icon'] }} text-primary"></i>
                                                        <span>{{ $permMeta['label'] }}</span>
                                                    </label>
                                                </div>
                                                <small class="text-muted d-block ps-4 mt-1" style="font-size: 0.8rem; line-height: 1.35;">
                                                    {{ $permMeta['desc'] }}
                                                </small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function toggleAllPermissions(checked) {
            document.querySelectorAll('.perm-checkbox').forEach(cb => {
                cb.checked = checked;
            });
        }

        function toggleGroupPermissions(groupSlug) {
            const groupCheckboxes = document.querySelectorAll('.group-' + groupSlug);
            const anyUnchecked = Array.from(groupCheckboxes).some(cb => !cb.checked);
            groupCheckboxes.forEach(cb => {
                cb.checked = anyUnchecked;
            });
        }
    </script>
    @endpush
@endsection
