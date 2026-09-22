@extends('admin.layouts.app')

@section('title', 'General Settings')

@section('breadcrumb')
    <li class="breadcrumb-item active">General Settings</li>
@endsection

@section('content')
    <div class="mb-4">
        <h1 class="page-title">General Settings</h1>
        <p class="text-muted mb-0">Manage site-wide settings</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <form action="{{ route('admin.settings.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-lg-8">
                <!-- Chat & Support Settings -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="bi bi-chat-dots me-2"></i>Chat & Support
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="whatsapp_number" class="form-label">WhatsApp Number</label>
                            <input type="text" class="form-control @error('whatsapp_number') is-invalid @enderror" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', $settings['whatsapp_number']) }}" placeholder="+1234567890">
                            <small class="text-muted">Include country code without spaces</small>
                            @error('whatsapp_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="crisp_website_id" class="form-label">Crisp Website ID</label>
                            <input type="text" class="form-control @error('crisp_website_id') is-invalid @enderror" id="crisp_website_id" name="crisp_website_id" value="{{ old('crisp_website_id', $settings['crisp_website_id']) }}" placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                            <small class="text-muted">Get your Crisp ID from <a href="https://crisp.chat" target="_blank">crisp.chat</a></small>
                            @error('crisp_website_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-lg me-2"></i>Save Settings
                        </button>
                    </div>
                </div>

                @if(auth()->user()->isSuperAdmin() || auth()->user()->hasAdminPermission('manage_employees'))
                <!-- Employee & Staff Management Shortcut Card -->
                <div class="card mb-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%); color: #fff;">
                    <div class="card-header bg-transparent border-0 text-white pb-0">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-people-fill text-indigo fs-5" style="color: #a5b4fc;"></i>
                            <h6 class="mb-0 fw-bold text-white">Staff & Employees</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="small text-slate-300 mb-3" style="color: #cbd5e1;">
                            Delegate sections and configure custom rights for each of your employees.
                        </p>
                        
                        <div class="p-2 rounded mb-3" style="background: rgba(255, 255, 255, 0.08); font-size: 0.78rem;">
                            <div class="text-muted text-uppercase mb-1" style="font-size: 0.7rem; color: #94a3b8 !important;">Employee Login URL:</div>
                            <code class="text-white user-select-all d-block text-truncate" style="color: #a5b4fc;">{{ url('/staff/login') }}</code>
                        </div>

                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.employees.create') }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-person-plus me-1"></i>Add New Employee
                            </a>
                            <a href="{{ route('admin.employees.index') }}" class="btn btn-sm btn-outline-light">
                                <i class="bi bi-gear me-1"></i>Manage Employee Permissions
                            </a>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </form>
@endsection

