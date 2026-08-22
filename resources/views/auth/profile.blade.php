@extends('layouts.app')

@section('title', 'My Profile - BestLiveIPTV')

@section('content')
<div class="profile-page-wrapper">
    <!-- Background Elements -->
    <div class="profile-bg">
        <div class="profile-bg-gradient"></div>
        <div class="profile-bg-pattern"></div>
        <div class="profile-glow profile-glow-1"></div>
        <div class="profile-glow profile-glow-2"></div>
    </div>

    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header" data-aos="fade-down">
            <div class="profile-header-content">
                <div class="header-avatar-section">
                    <div class="profile-avatar-wrapper">
                        <div class="profile-avatar">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="profile-status-badge">
                            <span class="status-indicator"></span>
                            <span>Active Member</span>
                        </div>
                    </div>
                </div>
                
                <div class="header-info-section">
                    <div class="header-top">
                        <h1 class="profile-welcome">Welcome back, <span class="text-gradient">{{ $user->name }}</span></h1>
                        <div class="profile-badges">
                            <span class="badge badge-glass">
                                <i class="ph-fill ph-user"></i> {{ $user->email }}
                            </span>
                            @if($user->isAdmin())
                            <span class="badge badge-admin">
                                <i class="ph-fill ph-crown"></i> Administrator
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="header-stats">
                        <div class="header-stat-item">
                            <div class="stat-icon">
                                <i class="ph-fill ph-shopping-cart"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">{{ $orders->count() }}</span>
                                <span class="stat-label">Total Orders</span>
                            </div>
                        </div>
                        <div class="header-stat-item">
                            <div class="stat-icon icon-success">
                                <i class="ph-fill ph-check-circle"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">{{ $orders->where('is_active', true)->count() }}</span>
                                <span class="stat-label">Active Plans</span>
                            </div>
                        </div>
                        <div class="header-stat-item">
                            <div class="stat-icon icon-purple">
                                <i class="ph-fill ph-currency-dollar"></i>
                            </div>
                            <div class="stat-text">
                                <span class="stat-value">${{ number_format($orders->sum('amount'), 0) }}</span>
                                <span class="stat-label">Total Spent</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="profile-layout-grid">
            <!-- Sidebar Navigation -->
            <aside class="profile-sidebar" data-aos="fade-right" data-aos-delay="100">
                <div class="sidebar-menu">
                    <a href="#overview" class="sidebar-link active" onclick="switchTab(event, 'overview')">
                        <i class="ph-fill ph-squares-four"></i>
                        <span>Overview</span>
                        @if(($userUnreadOrdersCount ?? 0) > 0)
                            <span class="badge badge-admin">{{ $userUnreadOrdersCount }}</span>
                        @endif
                    </a>
                    <a href="#settings" class="sidebar-link" onclick="switchTab(event, 'settings')">
                        <i class="ph-fill ph-gear"></i>
                        <span>Account Settings</span>
                    </a>
                    <a href="#security" class="sidebar-link" onclick="switchTab(event, 'security')">
                        <i class="ph-fill ph-lock-key"></i>
                        <span>Security</span>
                    </a>

                    <a href="#affiliate" class="sidebar-link" onclick="switchTab(event, 'affiliate')">
                        <i class="ph-fill ph-gift"></i>
                        <span>Affiliate Program</span>
                    </a>
                    
                    <div class="sidebar-divider"></div>
                    
                    @if($user->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link link-admin">
                        <i class="ph-fill ph-monitor"></i>
                        <span>Admin Dashboard</span>
                    </a>
                    @endif
                    
                    <a href="{{ route('packages.index') }}" class="sidebar-link link-primary">
                        <i class="ph-fill ph-plus-circle"></i>
                        <span>Buy New Package</span>
                    </a>
                    
                    <form action="{{ route('logout') }}" method="POST" class="logout-form">
                        @csrf
                        <button type="submit" class="sidebar-link link-danger">
                            <i class="ph-fill ph-sign-out"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="profile-main-content">
                <!-- Alerts -->
                @if(session('success'))
                <div class="alert-glass alert-success" data-aos="fade-in">
                    <div class="alert-icon"><i class="ph-fill ph-check-circle"></i></div>
                    <div class="alert-message">{{ session('success') }}</div>
                    <button class="alert-close" onclick="this.parentElement.remove()"><i class="ph ph-x"></i></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert-glass alert-error" data-aos="fade-in">
                    <div class="alert-icon"><i class="ph-fill ph-warning-circle"></i></div>
                    <div class="alert-message">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <!-- Overview Tab -->
                <div id="overview" class="tab-content active" data-aos="fade-up" data-aos-delay="200">
                    <div class="content-header">
                        <h2>Order History</h2>
                        <p>Manage your subscriptions and view past orders</p>
                    </div>

                    <div class="orders-container">
                        @forelse($orders as $order)
                        <div class="order-card-glass">
                            <div class="order-status-line {{ $order->is_active ? 'active' : 'expired' }}"></div>
                            <div class="order-main-info">
                                <div class="order-package-icon">
                                    <i class="ph-fill ph-television-simple"></i>
                                </div>
                                <div class="order-details">
                                    <h3>{{ $order->package->name ?? 'Premium Package' }}</h3>
                                    <span class="order-id">#{{ $order->order_number }}</span>
                                </div>
                            </div>
                            
                            <div class="order-meta-info">
                                <div class="meta-item">
                                    <span class="meta-label">Duration</span>
                                    <span class="meta-value">{{ $order->package->duration_label ?? '1 Month' }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Amount</span>
                                    <span class="meta-value price">${{ number_format($order->amount, 0) }}</span>
                                </div>
                                <div class="meta-item">
                                    <span class="meta-label">Status</span>
                                    <span class="status-badge {{ $order->is_active ? 'status-active' : 'status-expired' }}">
                                        {{ $order->is_active ? 'Active' : ucfirst($order->order_status) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="order-actions">
                                @if($order->expires_at)
                                <div class="expiry-date">
                                    <i class="ph ph-calendar-blank"></i>
                                    <span>{{ $order->is_active ? 'Expires' : 'Expired' }} {{ $order->expires_at->format('M d, Y') }}</span>
                                </div>
                                @endif
                                @if(!$order->is_active)
                                <a href="{{ route('packages.index') }}" class="btn-renew">
                                    Renew Now
                                </a>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="empty-state-glass">
                            <div class="empty-icon">
                                <i class="ph-duotone ph-shopping-cart-simple"></i>
                            </div>
                            <h3>No active subscriptions</h3>
                            <p>You haven't purchased any packages yet. Start streaming today!</p>
                            <a href="{{ route('packages.index') }}" class="btn-primary-glow">
                                Browse Packages <i class="ph-bold ph-arrow-right"></i>
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Settings Tab -->
                <div id="settings" class="tab-content" style="display: none;">
                    <div class="content-header">
                        <h2>Account Settings</h2>
                        <p>Update your personal information</p>
                    </div>

                    <div class="glass-form-card">
                        <form action="{{ route('profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-user"></i>
                                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required placeholder="Your Name">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-envelope"></i>
                                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required placeholder="email@example.com">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Phone Number relative</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-phone"></i>
                                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="+1 (555) 000-0000">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Country</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-globe"></i>
                                        <input type="text" name="country" value="{{ old('country', $user->country) }}" placeholder="Your Country">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn-primary-glow">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Tab -->
                <div id="security" class="tab-content" style="display: none;">
                    <div class="content-header">
                        <h2>Security</h2>
                        <p>Protect your account with a strong password</p>
                    </div>

                    <div class="glass-form-card">
                        <form action="{{ route('profile.password') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label>Current Password</label>
                                <div class="input-wrapper">
                                    <i class="ph ph-lock-open"></i>
                                    <input type="password" name="current_password" required placeholder="Enter current password">
                                </div>
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label>New Password</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-lock-key"></i>
                                        <input type="password" name="password" required placeholder="Min 8 characters">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <div class="input-wrapper">
                                        <i class="ph ph-check-square"></i>
                                        <input type="password" name="password_confirmation" required placeholder="Confirm new password">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="submit" class="btn-primary-glow">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Affiliate Tab -->
                <div id="affiliate" class="tab-content" style="display: none;">
                    <div class="content-header">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <div>
                                <h2>Affiliate Dashboard</h2>
                                <p>Track clicks, buyers, and earnings from your referral link</p>
                            </div>
                            <span class="badge badge-success" style="background: rgba(16, 185, 129, 0.1); color: #34D399; border: 1px solid rgba(16, 185, 129, 0.2);">
                                <i class="ph-fill ph-check-circle"></i> Active
                            </span>
                        </div>
                    </div>

                    @include('partials.affiliate-stats', ['affiliate' => $affiliate, 'stats' => $stats])

                    <!-- Referral Link & Code -->
                    <div class="glass-form-card" style="background: linear-gradient(135deg, rgba(0, 102, 255, 0.1) 0%, rgba(0, 82, 204, 0.2) 100%); border: 1px solid rgba(0, 102, 255, 0.2);">
                        <h3 style="font-size: 1.25rem; font-weight: 600; color: #fff; margin-bottom: 20px; display: flex; align-items: center; gap: 10px;">
                            <i class="ph-fill ph-link"></i> Your Referral Tools
                        </h3>
                        
                        <div class="form-grid">
                            <div class="form-group">
                                <label style="color: rgba(255,255,255,0.8);">Referral Link</label>
                                <div class="input-wrapper" style="background: rgba(0, 0, 0, 0.2);">
                                    <i class="ph ph-link"></i>
                                    <input type="text" id="referralLink" value="{{ auth()->user()->referral_link }}" readonly style="background: transparent; border: none; font-family: monospace;">
                                    <button type="button" onclick="copyToClipboard('referralLink', this)" style="background: rgba(255,255,255,0.1); border: none; color: white; padding: 4px 12px; border-radius: 6px; cursor: pointer;">
                                        <i class="ph ph-copy"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label style="color: rgba(255,255,255,0.8);">Referral Code</label>
                                <div class="input-wrapper" style="background: rgba(0, 0, 0, 0.2);">
                                    <i class="ph ph-tag"></i>
                                    <input type="text" id="referralCode" value="{{ $affiliate->referral_code }}" readonly style="background: transparent; border: none; font-family: monospace; font-weight: bold; letter-spacing: 1px;">
                                    <button type="button" onclick="copyToClipboard('referralCode', this)" style="background: rgba(255,255,255,0.1); border: none; color: white; padding: 4px 12px; border-radius: 6px; cursor: pointer;">
                                        <i class="ph ph-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="form-grid" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
                        <a href="{{ route('affiliate.referrals') }}" class="btn-primary-glow" style="text-align: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <i class="ph ph-users"></i> View Referrals
                        </a>
                        <a href="{{ route('affiliate.commissions') }}" class="btn-primary-glow" style="text-align: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <i class="ph ph-receipt"></i> Commissions
                        </a>
                        <a href="{{ route('affiliate.payouts') }}" class="btn-primary-glow" style="text-align: center; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                            <i class="ph ph-wallet"></i> Payouts
                        </a>
                    </div>

                </div>
            </main>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Check for hash in URL
    if (window.location.hash) {
        const tabId = window.location.hash.substring(1);
        const tabLink = document.querySelector(`.sidebar-link[href="#${tabId}"]`);
        if (tabLink) {
            tabLink.click();
        }
    }
});

function switchTab(event, tabId) {
    if (event) event.preventDefault();
    
    // Update URL hash without scrolling
    history.pushState(null, null, `#${tabId}`);
    
    // Hide all tabs
    document.querySelectorAll('.tab-content').forEach(tab => {
        tab.style.display = 'none';
        tab.classList.remove('active');
    });
    
    // Show selected tab
    const selectedTab = document.getElementById(tabId);
    if (selectedTab) {
        selectedTab.style.display = 'block';
        // Small delay to allow display:block to apply before opacity transition
        setTimeout(() => selectedTab.classList.add('active'), 10);
    }
    
    // Update menu links
    document.querySelectorAll('.sidebar-link').forEach(link => {
        link.classList.remove('active');
    });
    
    // Activate link
    const activeLink = document.querySelector(`.sidebar-link[href="#${tabId}"]`);
    if (activeLink) {
        activeLink.classList.add('active');
    }
    
    // Scroll to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function copyToClipboard(elementId, btn) {
    const input = document.getElementById(elementId);
    input.select();
    input.setSelectionRange(0, 99999); // For mobile devices
    
    navigator.clipboard.writeText(input.value).then(() => {
        const originalInfo = btn.innerHTML;
        btn.innerHTML = '<i class="ph-fill ph-check"></i>';
        btn.style.color = '#34D399';
        
        setTimeout(() => {
            btn.innerHTML = originalInfo;
            btn.style.color = '';
        }, 2000);
    });
}
</script>
@endpush

@push('styles')
<style>
/* =========================================
   DARK GLASSMOPHISM THEME
   Professional Dashboard Design
   ========================================= */

:root {
    --glass-bg: rgba(20, 25, 40, 0.7);
    --glass-border: rgba(255, 255, 255, 0.08);
    --glass-shine: rgba(255, 255, 255, 0.03);
    --text-primary: #ffffff;
    --text-secondary: #94a3b8;
    --accent-blue: #0066FF;
    --accent-glow: rgba(0, 102, 255, 0.5);
    --page-bg: #030508;
}

/* Page Wrapper */
.profile-page-wrapper {
    position: relative;
    min-height: 100vh;
    padding-top: 100px;
    padding-bottom: 80px;
    background-color: var(--page-bg);
    overflow-x: hidden;
    color: var(--text-primary);
}

/* Background Effects */
.profile-bg {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 0;
    overflow: hidden;
    pointer-events: none;
}

.profile-bg-gradient {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 50% 0%, #0f172a 0%, #020617 100%);
}

.profile-bg-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 50px 50px;
    mask-image: linear-gradient(to bottom, black 0%, transparent 80%);
}

.profile-glow {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    opacity: 0.4;
    animation: glowFloat 10s infinite alternate;
}

.profile-glow-1 {
    width: 600px;
    height: 600px;
    background: #0066FF;
    top: -20%;
    right: -10%;
}

.profile-glow-2 {
    width: 500px;
    height: 500px;
    background: #00D4FF;
    bottom: -10%;
    left: -10%;
    animation-delay: -5s;
}

@keyframes glowFloat {
    0% { transform: translate(0, 0); }
    100% { transform: translate(30px, 30px); }
}

/* Layout Grid */
.profile-layout-grid {
    display: grid;
    grid-template-columns: 280px 1fr;
    gap: 2rem;
    align-items: start;
    position: relative;
    z-index: 10;
}

@media (max-width: 992px) {
    .profile-layout-grid {
        grid-template-columns: 1fr;
    }
}

/* Profile Header */
.profile-header {
    position: relative;
    z-index: 10;
    margin-bottom: 2.5rem;
    background: rgba(255, 255, 255, 0.03);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.3);
}

.profile-header-content {
    display: flex;
    gap: 2.5rem;
    align-items: center;
}

@media (max-width: 768px) {
    .profile-header-content {
        flex-direction: column;
        text-align: center;
    }
}

.profile-avatar-wrapper {
    position: relative;
}

.profile-avatar {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0066FF, #00D4FF);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: 800;
    color: white;
    box-shadow: 0 0 30px rgba(0, 102, 255, 0.4);
    border: 4px solid rgba(255, 255, 255, 0.1);
}

.profile-status-badge {
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    background: rgba(10, 15, 30, 0.9);
    border: 1px solid var(--glass-border);
    padding: 0.3rem 0.8rem;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 0.75rem;
    font-weight: 600;
    white-space: nowrap;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.status-indicator {
    width: 8px;
    height: 8px;
    background: #10B981;
    border-radius: 50%;
    box-shadow: 0 0 10px #10B981;
}

.header-info-section {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.profile-welcome {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    color: white;
}

.text-gradient {
    background: linear-gradient(to right, #60A5FA, #34D399);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.profile-badges {
    display: flex;
    gap: 0.8rem;
    flex-wrap: wrap;
}

@media (max-width: 768px) {
    .profile-badges {
        justify-content: center;
    }
}

.badge {
    padding: 0.4rem 1rem;
    border-radius: 50px;
    font-size: 0.875rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
}

.badge-glass {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-secondary);
}

.badge-admin {
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.3);
    color: #FBBF24;
}

.header-stats {
    display: flex;
    gap: 2rem;
    padding-top: 1rem;
    border-top: 1px solid var(--glass-border);
}

@media (max-width: 768px) {
    .header-stats {
        flex-wrap: wrap;
        justify-content: center;
    }
}

.header-stat-item {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(0, 102, 255, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: #60A5FA;
}

.stat-icon.icon-success { background: rgba(16, 185, 129, 0.1); color: #34D399; }
.stat-icon.icon-purple { background: rgba(139, 92, 246, 0.1); color: #A78BFA; }

.stat-text {
    display: flex;
    flex-direction: column;
}

.stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    color: white;
}

.stat-label {
    font-size: 0.8rem;
    color: var(--text-secondary);
}

/* Sidebar */
.profile-sidebar {
    position: sticky;
    top: 100px;
}

.sidebar-menu {
    background: rgba(20, 25, 40, 0.6);
    backdrop-filter: blur(20px);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 1.25rem;
    border-radius: 12px;
    color: var(--text-secondary);
    transition: all 0.3s ease;
    text-decoration: none;
    font-weight: 500;
    border: 1px solid transparent;
}

.sidebar-link:hover {
    background: rgba(255, 255, 255, 0.05);
    color: white;
    transform: translateX(5px);
}

.sidebar-link.active {
    background: linear-gradient(90deg, rgba(0, 102, 255, 0.15), transparent);
    border-color: rgba(0, 102, 255, 0.2);
    color: white;
    font-weight: 600;
}

.sidebar-link i {
    font-size: 1.25rem;
}

.sidebar-link.active i {
    color: #60A5FA;
}

.sidebar-divider {
    height: 1px;
    background: var(--glass-border);
    margin: 0.5rem 0;
}

.logout-form { margin: 0; }
.logout-form button { 
    width: 100%; 
    background: none; 
    border: none; 
    cursor: pointer; 
    text-align: left;
    font-family: inherit;
    font-size: inherit;
}

.link-danger:hover {
    background: rgba(239, 68, 68, 0.1);
    color: #F87171;
}

.link-primary { color: #60A5FA; }

/* Main Content */
.content-header {
    margin-bottom: 2rem;
}

.content-header h2 {
    font-size: 1.75rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
}

.content-header p {
    color: var(--text-secondary);
}

.tab-content {
    opacity: 0;
    animation: fadeIn 0.4s forwards;
}

@keyframes fadeIn {
    to { opacity: 1; }
}

/* Glass Cards */
.glass-form-card, .order-card-glass, .empty-state-glass {
    background: linear-gradient(180deg, rgba(30, 41, 59, 0.4) 0%, rgba(15, 23, 42, 0.6) 100%);
    backdrop-filter: blur(10px);
    border: 1px solid var(--glass-border);
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 1.5rem;
}

/* Orders Styles */
.order-card-glass {
    position: relative;
    overflow: hidden;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 2rem;
    transition: transform 0.3s ease, border-color 0.3s ease;
}

.order-card-glass:hover {
    transform: translateY(-2px);
    border-color: rgba(0, 102, 255, 0.3);
    background: linear-gradient(180deg, rgba(30, 41, 59, 0.5) 0%, rgba(15, 23, 42, 0.7) 100%);
}

.order-status-line {
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 4px;
}

.order-status-line.active { background: #10B981; box-shadow: 0 0 10px #10B981; }
.order-status-line.expired { background: #64748B; }

.order-main-info {
    display: flex;
    align-items: center;
    gap: 1.25rem;
}

.order-package-icon {
    width: 54px;
    height: 54px;
    border-radius: 12px;
    background: linear-gradient(135deg, rgba(0, 102, 255, 0.2), rgba(0, 212, 255, 0.1));
    color: #60A5FA;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    border: 1px solid rgba(0, 102, 255, 0.2);
}

.order-details h3 {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0.25rem;
}

.order-id {
    font-size: 0.85rem;
    color: var(--text-secondary);
    font-family: monospace;
}

.order-meta-info {
    flex: 1;
    display: flex;
    justify-content: space-around;
    gap: 1rem;
}

@media (max-width: 768px) {
    .order-meta-info {
        flex-basis: 100%;
        justify-content: space-between;
        background: rgba(255,255,255,0.03);
        padding: 1rem;
        border-radius: 12px;
    }
}

.meta-item {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.meta-label {
    font-size: 0.75rem;
    color: var(--text-secondary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.meta-value {
    font-weight: 600;
    font-size: 1rem;
}

.meta-value.price {
    color: #60A5FA;
    font-family: var(--font-display, sans-serif);
}

.status-badge {
    display: inline-flex;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
}

.status-active { background: rgba(16, 185, 129, 0.2); color: #34D399; }
.status-expired { background: rgba(100, 116, 139, 0.2); color: #94A3B8; }

.order-actions {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 0.5rem;
}

.expiry-date {
    font-size: 0.85rem;
    color: var(--text-secondary);
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.btn-renew {
    padding: 0.5rem 1.25rem;
    background: transparent;
    border: 1px solid #60A5FA;
    color: #60A5FA;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.btn-renew:hover {
    background: #60A5FA;
    color: white;
    box-shadow: 0 0 15px rgba(96, 165, 250, 0.4);
}

.empty-state-glass {
    text-align: center;
    padding: 4rem 2rem;
}

.empty-icon {
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.1);
    margin-bottom: 1.5rem;
}

/* Forms */
.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
    margin-bottom: 2rem;
}

@media (max-width: 640px) {
    .form-grid { grid-template-columns: 1fr; }
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-secondary);
}

.input-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-wrapper i {
    position: absolute;
    left: 1.25rem;
    color: var(--text-secondary);
    font-size: 1.2rem;
    transition: color 0.3s ease;
}

.input-wrapper input {
    width: 100%;
    padding: 1rem 1rem 1rem 3.5rem;
    background: rgba(15, 23, 42, 0.6);
    border: 1px solid var(--glass-border);
    border-radius: 12px;
    color: white;
    font-size: 1rem;
    transition: all 0.3s ease;
}

.input-wrapper input:focus {
    outline: none;
    border-color: #60A5FA;
    background: rgba(15, 23, 42, 0.8);
    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.15);
}

.input-wrapper input:focus + i, 
.input-wrapper input:not(:placeholder-shown) + i {
    color: #60A5FA;
}

.btn-primary-glow {
    background: linear-gradient(135deg, #0066FF, #0052CC);
    color: white;
    padding: 1rem 2.5rem;
    border-radius: 12px;
    border: none;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 20px rgba(0, 102, 255, 0.3);
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
}

.btn-primary-glow:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(0, 102, 255, 0.5);
}

/* Alerts */
.alert-glass {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
    padding: 1.25rem;
    border-radius: 16px;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border: 1px solid rgba(16, 185, 129, 0.2);
    color: #34D399;
}

.alert-error {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.2);
    color: #F87171;
}

.alert-close {
    margin-left: auto;
    background: none;
    border: none;
    color: currentColor;
    opacity: 0.7;
    cursor: pointer;
    font-size: 1.2rem;
}
</style>
@endpush
