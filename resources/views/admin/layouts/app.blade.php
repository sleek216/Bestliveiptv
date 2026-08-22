<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - Best Live IPTV</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --sidebar-width: 260px;
            --primary-color: #6366f1;
            --primary-dark: #4f46e5;
            --dark-bg: #0f172a;
            --dark-card: #1e293b;
            --dark-border: #334155;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
        }
        
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-width);
            height: 100vh;
            background: var(--dark-bg);
            color: #fff;
            z-index: 1000;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }
        
        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid var(--dark-border);
        }
        
        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .sidebar-brand i {
            color: var(--primary-color);
        }
        
        .sidebar-nav {
            padding: 1rem 0;
        }
        
        .nav-section {
            padding: 0.5rem 1.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            color: #64748b;
            letter-spacing: 0.05em;
        }
        
        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1.5rem;
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }
        
        .nav-link:hover {
            color: #fff;
            background: rgba(99, 102, 241, 0.1);
        }
        
        .nav-link.active {
            color: #fff;
            background: rgba(99, 102, 241, 0.15);
            border-left-color: var(--primary-color);
        }
        
        .nav-link i {
            font-size: 1.1rem;
            width: 24px;
        }
        
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        
        .top-header {
            background: #fff;
            padding: 1rem 2rem;
            border-bottom: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        
        .content-wrapper {
            padding: 2rem;
        }
        
        .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-bg);
            margin-bottom: 0.25rem;
        }
        
        .breadcrumb {
            margin-bottom: 0;
            font-size: 0.875rem;
        }
        
        .card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #e2e8f0;
            background: transparent;
            font-weight: 600;
        }
        
        .card-body {
            padding: 1.5rem;
        }
        
        .stat-card {
            padding: 1.5rem;
            border-radius: 0.75rem;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: #fff;
        }
        
        .stat-card.green {
            background: linear-gradient(135deg, #10b981, #059669);
        }
        
        .stat-card.orange {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }
        
        .stat-card.red {
            background: linear-gradient(135deg, #ef4444, #dc2626);
        }
        
        .stat-value {
            font-size: 2rem;
            font-weight: 700;
        }
        
        .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
        }
        
        .table {
            margin-bottom: 0;
        }
        
        .table th {
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .table td {
            vertical-align: middle;
            padding: 1rem;
        }
        
        .btn-primary {
            background: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }
        
        .badge {
            padding: 0.35em 0.65em;
            font-weight: 500;
        }
        
        .form-control, .form-select {
            border-color: #e2e8f0;
            padding: 0.625rem 1rem;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
        }
        
        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 0.5rem;
        }
        
        .alert {
            border: none;
            border-radius: 0.5rem;
        }
        
        .user-dropdown {
            position: relative;
        }
        
        .user-dropdown .dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            text-decoration: none;
            color: var(--dark-bg);
        }
        
        .user-avatar {
            width: 32px;
            height: 32px;
            background: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
            font-size: 0.875rem;
        }
        
        @media (max-width: 991.98px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <i class="bi bi-tv"></i>
                <span>Best Live IPTV</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <div class="nav-section">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
            
            <div class="nav-section mt-3">Management</div>
            @if(auth()->user()->hasAdminPermission('packages'))
            <a href="{{ route('admin.packages.index') }}" class="nav-link {{ request()->routeIs('admin.packages.*') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i>
                <span>Packages</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('orders'))
            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                <i class="bi bi-cart3"></i>
                <span>Orders</span>
                @if(($adminUnreadOrdersCount ?? 0) > 0)
                    <span class="badge bg-danger ms-auto">{{ $adminUnreadOrdersCount }}</span>
                @endif
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('users'))
            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                <span>Users</span>
                @if(($adminUnreadUsersCount ?? 0) > 0)
                    <span class="badge bg-danger ms-auto">{{ $adminUnreadUsersCount }}</span>
                @endif
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('countries'))
            <a href="{{ route('admin.countries.index') }}" class="nav-link {{ request()->routeIs('admin.countries.*') ? 'active' : '' }}">
                <i class="bi bi-globe"></i>
                <span>Countries</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('coupons'))
            <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                <i class="bi bi-tag"></i>
                <span>Coupons</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('contacts'))
            <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                <i class="bi bi-envelope-fill"></i>
                <span>Contacts</span>
                @if(($adminUnreadContactsCount ?? 0) > 0)
                    <span class="badge bg-danger ms-auto">{{ $adminUnreadContactsCount }}</span>
                @endif
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('announcement'))
            <a href="{{ route('admin.announcement.index') }}" class="nav-link {{ request()->routeIs('admin.announcement.*') ? 'active' : '' }}">
                <i class="bi bi-megaphone"></i>
                <span>Announcement Bar</span>
            </a>
            @endif
            <a href="{{ route('admin.blogs.index') }}" class="nav-link {{ request()->routeIs('admin.blogs.*') ? 'active' : '' }}">
                <i class="bi bi-journal-text"></i>
                <span>Blog Management</span>
            </a>

            <div class="nav-section mt-3">Affiliate Program</div>
            @if(auth()->user()->hasAdminPermission('affiliate_overview'))
            <a href="{{ route('admin.affiliate.index') }}" class="nav-link {{ request()->routeIs('admin.affiliate.index') ? 'active' : '' }}">
                <i class="bi bi-graph-up"></i>
                <span>Overview</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('affiliate_affiliates'))
            <a href="{{ route('admin.affiliate.affiliates') }}" class="nav-link {{ request()->routeIs('admin.affiliate.affiliates') ? 'active' : '' }}">
                <i class="bi bi-person-plus"></i>
                <span>Referred Users</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('affiliate_referrals'))
            <a href="{{ route('admin.affiliate.referrals') }}" class="nav-link {{ request()->routeIs('admin.affiliate.referrals') ? 'active' : '' }}">
                <i class="bi bi-link-45deg"></i>
                <span>Referrals</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('affiliate_commissions'))
            <a href="{{ route('admin.affiliate.commissions') }}" class="nav-link {{ request()->routeIs('admin.affiliate.commissions') ? 'active' : '' }}">
                <i class="bi bi-cash-coin"></i>
                <span>Commissions</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('affiliate_payouts'))
            <a href="{{ route('admin.affiliate.payouts') }}" class="nav-link {{ request()->routeIs('admin.affiliate.payouts') ? 'active' : '' }}">
                <i class="bi bi-wallet2"></i>
                <span>Payouts</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('affiliate_settings'))
            <a href="{{ route('admin.affiliate.settings') }}" class="nav-link {{ request()->routeIs('admin.affiliate.settings') ? 'active' : '' }}">
                <i class="bi bi-sliders"></i>
                <span>Settings</span>
            </a>
            @endif
            
            <div class="nav-section mt-3">Settings</div>
            @if(auth()->user()->hasAdminPermission('settings_general'))
            <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.index') ? 'active' : '' }}">
                <i class="bi bi-gear"></i>
                <span>General Settings</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('settings_stripe'))
            <a href="{{ route('admin.settings.stripe') }}" class="nav-link {{ request()->routeIs('admin.settings.stripe') ? 'active' : '' }}">
                <i class="bi bi-credit-card"></i>
                <span>Stripe Gateway</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('settings_nowpayments'))
            <a href="{{ route('admin.settings.nowpayments') }}" class="nav-link {{ request()->routeIs('admin.settings.nowpayments') ? 'active' : '' }}">
                <i class="bi bi-currency-bitcoin"></i>
                <span>NOWPayments Crypto</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('settings_email'))
            <a href="{{ route('admin.settings.email') }}" class="nav-link {{ request()->routeIs('admin.settings.email') ? 'active' : '' }}">
                <i class="bi bi-envelope"></i>
                <span>Email Settings</span>
            </a>
            @endif
            @if(auth()->user()->hasAdminPermission('settings_security'))
            <a href="{{ route('admin.security.index') }}" class="nav-link {{ request()->routeIs('admin.security.*') ? 'active' : '' }}">
                <i class="bi bi-shield-lock"></i>
                <span>Security (2FA)</span>
            </a>
            @endif

            
            <div class="nav-section mt-3">Quick Links</div>
            <a href="{{ route('home') }}" class="nav-link" target="_blank">
                <i class="bi bi-box-arrow-up-right"></i>
                <span>View Website</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <button class="btn btn-link d-lg-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
                <i class="bi bi-list fs-4"></i>
            </button>
            
            <div class="d-none d-lg-block">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Admin</a></li>
                        @yield('breadcrumb')
                    </ol>
                </nav>
            </div>
            
            <div class="user-dropdown dropdown">
                <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <div class="user-avatar">{{ substr(auth()->user()->name, 0, 1) }}</div>
                    <span>{{ auth()->user()->name }}</span>
                    <i class="bi bi-chevron-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile') }}"><i class="bi bi-person me-2"></i>Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-box-arrow-right me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Content -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
