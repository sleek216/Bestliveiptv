@extends('layouts.app')

@section('title', 'Pricing Plans - BestLiveIPTV')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="page-hero-bg">
        <div class="page-hero-pattern"></div>
        <div class="page-hero-glow page-hero-glow-1"></div>
        <div class="page-hero-glow page-hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="page-hero-content">
            <div class="page-hero-text" data-aos="fade-right">
                <h1 class="page-hero-title">
                    Choose Your <span class="text-gradient">Perfect Plan</span>
                </h1>
                
                <p class="page-hero-subtitle">
                    Flexible pricing options for everyone. All plans include access to 
                    20,000+ channels, HD & 4K quality, and premium features.
                </p>
                
                <div class="page-hero-features">
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>No Contracts</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Instant Access</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Money Back</span>
                    </div>
                </div>
            </div>
            
            <div class="page-hero-visual" data-aos="fade-left" data-aos-delay="200">
                <div class="page-hero-image">
                    <div class="page-hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1593784991095-a205069470b6?w=600&h=400&fit=crop" 
                             alt="IPTV Pricing Plans" 
                             class="page-hero-img"
                             loading="lazy">
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-1">
                        <div class="page-hero-floating-icon green">
                            <i class="ph-fill ph-check"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">50%</span>
                            <span class="page-hero-floating-label">Discount</span>
                        </div>
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-2">
                        <div class="page-hero-floating-icon cyan">
                            <i class="ph-fill ph-star"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">4.9/5</span>
                            <span class="page-hero-floating-label">Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Filter Tabs -->
<section class="pricing-tabs-section">
    <div class="container">
        <div class="pricing-tabs" data-aos="fade-up">
            <button class="tab-btn active" data-tab="all">
                <i class="ph ph-squares-four"></i>
                All Packages
            </button>
            <button class="tab-btn" data-tab="1_month">1 Month</button>
            <button class="tab-btn" data-tab="3_months">3 Months</button>
            <button class="tab-btn" data-tab="6_months">6 Months</button>
            <button class="tab-btn popular" data-tab="12_months">
                12 Months
                <span class="tab-badge">Best Value</span>
            </button>
            <button class="tab-btn" data-tab="recharge">
                <i class="ph ph-arrow-clockwise"></i>
                Recharge
            </button>
            <button class="tab-btn" data-tab="lifetime">
                <i class="ph ph-infinity"></i>
                Lifetime
            </button>
        </div>
    </div>
</section>

<!-- Packages Grid -->
<section class="packages-section">
    <div class="container">
        @if($packagesByDuration['all']->count() > 0)
        <div class="packages-grid">
            @foreach($packagesByDuration as $duration => $durationPackages)
                @foreach($durationPackages as $package)
                <div class="pricing-card {{ $package->is_popular ? 'popular' : '' }}" 
                     data-duration="{{ $duration }}" 
                     data-aos="fade-up" 
                     data-aos-delay="50"
                     style="{{ $duration !== 'all' ? 'display: none;' : '' }}">
                    @if($package->is_popular)
                    <div class="popular-badge">
                        <i class="ph-fill ph-crown"></i> Most Popular
                    </div>
                    @endif
                    
                    @if($package->discount_percentage)
                    <div class="discount-badge">
                        <span>{{ $package->discount_percentage }}% OFF</span>
                    </div>
                    @endif
                    
                    <div class="pricing-header">
                        <h3 class="plan-name">{{ $package->name }}</h3>
                        <p class="plan-devices">{{ $package->devices }} {{ $package->devices > 1 ? 'Devices' : 'Device' }}</p>
                    </div>
                    
                    <div class="pricing-price">
                        @if($package->original_price)
                        <span class="original-price">${{ number_format($package->original_price, 0) }}</span>
                        @endif
                        <span class="current-price">
                            <span class="currency">$</span>
                            <span class="amount">{{ number_format($package->price, 0) }}</span>
                        </span>
                        <span class="period">{{ $package->duration_label }}</span>
                    </div>
                    
                    <ul class="pricing-features">
                        <li><i class="ph-fill ph-check-circle"></i> 20,000+ Channels & VOD</li>
                        <li><i class="ph-fill ph-check-circle"></i> HD & 4K Image Quality</li>
                        <li><i class="ph-fill ph-check-circle"></i> TV Guide (EPG)</li>
                        <li><i class="ph-fill ph-check-circle"></i> Anti-Freeze Technology</li>
                        <li><i class="ph-fill ph-check-circle"></i> Instant Delivery</li>
                        <li><i class="ph-fill ph-check-circle"></i> 24/7 Customer Support</li>
                    </ul>
                    
                    <a href="{{ route('checkout.show', $package->slug) }}" class="btn {{ $package->is_popular ? 'btn-primary' : 'btn-outline' }} btn-block">
                        <i class="ph ph-shopping-cart"></i>
                        Order Now
                    </a>
                </div>
                @endforeach
            @endforeach
        </div>
        @else
        <div class="empty-state" data-aos="fade-up">
            <div class="empty-icon">
                <i class="ph ph-package"></i>
            </div>
            <h3>No packages found</h3>
            <p>Try adjusting your filters to see available packages.</p>
            <a href="{{ route('packages.index') }}" class="btn btn-primary">
                <i class="ph ph-arrow-counter-clockwise"></i>
                Reset Filters
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Features Banner -->
<section class="features-banner">
    <div class="container">
        <div class="banner-grid" data-aos="fade-up">
            <div class="banner-item">
                <i class="ph-fill ph-lightning"></i>
                <span>Instant Delivery</span>
            </div>
            <div class="banner-item">
                <i class="ph-fill ph-shield-check"></i>
                <span>Secure Payment</span>
            </div>
            <div class="banner-item">
                <i class="ph-fill ph-headset"></i>
                <span>24/7 Support</span>
            </div>
            <div class="banner-item">
                <i class="ph-fill ph-arrow-counter-clockwise"></i>
                <span>Money Back Guarantee</span>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .page-hero {
        position: relative;
        padding: 180px 0 80px;
        text-align: center;
        overflow: hidden;
    }
    
    .page-hero .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: -1;
    }
    
    .page-hero .hero-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, #0a0f1a 0%, #0d1525 50%, #0a0f1a 100%);
    }
    
    .page-hero .hero-pattern {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: radial-gradient(rgba(0, 102, 255, 0.1) 1px, transparent 1px);
        background-size: 40px 40px;
        opacity: 0.5;
    }
    
    .page-hero-content {
        max-width: 700px;
        margin: 0 auto;
        color: var(--white);
    }
    
    .page-title {
        font-family: var(--font-display);
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        margin-bottom: 1rem;
    }
    
    .page-subtitle {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.7;
    }
    
    .filters-section {
        padding: 2rem 0;
        background: var(--white);
        border-bottom: 1px solid var(--gray-100);
        position: sticky;
        top: 124px;
        z-index: 50;
    }
    
    .filters-wrapper {
        display: flex;
        flex-wrap: wrap;
        gap: 2rem;
        align-items: center;
        justify-content: center;
    }
    
    .filter-group {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .filter-label {
        font-weight: 600;
        color: var(--gray-700);
        font-size: 0.875rem;
    }
    
    .filter-buttons {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-600);
        background: var(--gray-100);
        border-radius: var(--radius-full);
        transition: var(--transition-base);
    }
    
    .filter-btn:hover {
        background: var(--primary-100);
        color: var(--primary-600);
    }
    
    .filter-btn.active {
        background: var(--gradient-primary);
        color: var(--white);
    }
    
    .packages-section {
        padding: 4rem 0 6rem;
        background: var(--gray-50);
    }
    
    .packages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }
    
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--white);
        border-radius: var(--radius-xl);
        border: 2px dashed var(--gray-200);
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-100);
        border-radius: var(--radius-full);
        margin: 0 auto 1.5rem;
    }
    
    .empty-icon i {
        font-size: 2.5rem;
        color: var(--gray-400);
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: var(--gray-600);
        margin-bottom: 1.5rem;
    }
    
    .features-banner {
        padding: 3rem 0;
        background: var(--white);
    }
    
    .banner-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 2rem;
    }
    
    .banner-item {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.75rem;
        padding: 1rem;
    }
    
    .banner-item i {
        font-size: 1.5rem;
        color: var(--primary-500);
    }
    
    .banner-item span {
        font-weight: 600;
        color: var(--gray-700);
    }
    
    @media (max-width: 768px) {
        .page-hero {
            padding: 140px 0 60px;
        }
        
        .filters-section {
            top: 108px;
        }
        
        .filter-group {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
        }
        
        .banner-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }
    }
    
    /* Pricing Tabs Section */
    .pricing-tabs-section {
        padding: 2rem 0;
        background: var(--white);
        border-bottom: 1px solid var(--gray-100);
        position: sticky;
        top: 124px;
        z-index: 100;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }
    
    .pricing-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: center;
        align-items: center;
    }
    
    .pricing-tabs .tab-btn {
        padding: 0.75rem 1.5rem;
        font-size: 0.9375rem;
        font-weight: 600;
        color: var(--gray-700);
        background: var(--gray-100);
        border: 2px solid transparent;
        border-radius: var(--radius-full);
        transition: all 0.3s ease;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
    }
    
    .pricing-tabs .tab-btn i {
        font-size: 1.1rem;
    }
    
    .pricing-tabs .tab-btn:hover {
        background: var(--primary-50);
        color: var(--primary-600);
        transform: translateY(-2px);
    }
    
    .pricing-tabs .tab-btn.active {
        background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
        color: var(--white);
        border-color: var(--primary-600);
        box-shadow: 0 4px 12px rgba(0, 102, 255, 0.3);
    }
    
    .pricing-tabs .tab-btn.popular {
        position: relative;
    }
    
    .pricing-tabs .tab-badge {
        position: absolute;
        top: -8px;
        right: -8px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        font-size: 0.625rem;
        padding: 0.125rem 0.375rem;
        border-radius: var(--radius-full);
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.4);
    }
    
    @media (max-width: 768px) {
        .pricing-tabs-section {
            top: 108px;
            padding: 1rem 0;
        }
        
        .pricing-tabs {
            gap: 0.5rem;
        }
        
        .pricing-tabs .tab-btn {
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }
        
        .pricing-tabs .tab-btn i {
            font-size: 1rem;
        }
    }
</style>

<script>
// Pricing Tabs Functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabButtons = document.querySelectorAll('.pricing-tabs .tab-btn');
    const pricingCards = document.querySelectorAll('.pricing-card');
    
    tabButtons.forEach(button => {
        button.addEventListener('click', function() {
            const selectedDuration = this.getAttribute('data-tab');
            
            // Update active tab
            tabButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter pricing cards with smooth animation
            pricingCards.forEach(card => {
                const cardDuration = card.getAttribute('data-duration');
                
                if (cardDuration === selectedDuration) {
                    // Show card with fade-in animation
                    card.style.display = 'block';
                    setTimeout(() => {
                        card.style.opacity = '0';
                        card.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            card.style.transition = 'all 0.4s ease';
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, 10);
                    }, 10);
                } else {
                    // Hide card with fade-out animation
                    card.style.transition = 'all 0.3s ease';
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        card.style.display = 'none';
                    }, 300);
                }
            });
        });
    });
});
</script>
</style>
@endpush
@endsection
