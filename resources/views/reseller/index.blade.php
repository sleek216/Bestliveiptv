@extends('layouts.app')

@section('title', 'Become a Reseller - BestLiveIPTV')

@section('content')
<!-- Page Hero Section -->
<section class="page-hero">
    <div class="page-hero-bg">
        <div class="page-hero-pattern"></div>
        <div class="page-hero-glow page-hero-glow-1"></div>
        <div class="page-hero-glow page-hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="page-hero-content">
            <div class="page-hero-text" data-aos="fade-right">
                <div class="page-hero-badge">
                    <i class="ph-fill ph-briefcase"></i>
                    <span>Business Opportunity</span>
                </div>
                
                <h1 class="page-hero-title">
                    Become an IPTV <span class="text-gradient">Reseller</span>
                </h1>
                
                <p class="page-hero-subtitle">
                    Start your own IPTV business with our premium reseller panel. 
                    Get the best wholesale prices, high stability servers, and dedicated 24/7 support.
                </p>
                
                <div class="page-hero-features">
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>White Label Panel</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>High Profit Margins</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-check-circle"></i>
                        <span>Instant Activation</span>
                    </div>
                </div>
                
                <div class="hero-cta" style="margin-top: 2rem;">
                    <a href="#reseller-packages" class="btn btn-primary btn-lg">
                        <i class="ph ph-shopping-cart"></i>
                        View Reseller Packages
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-glass btn-lg">
                        <i class="ph ph-chat-circle-text"></i>
                        Contact Us
                    </a>
                </div>
            </div>
            
            <div class="page-hero-visual" data-aos="fade-left" data-aos-delay="200">
                <div class="reseller-stats-card">
                    <div class="reseller-stats-header">
                        <div class="stats-icon">
                            <i class="ph-fill ph-chart-line-up"></i>
                        </div>
                        <span>Reseller Dashboard</span>
                    </div>
                    <div class="reseller-stats-grid">
                        <div class="stat-item">
                            <span class="stat-value">$50K+</span>
                            <span class="stat-label">Monthly Earnings</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">500+</span>
                            <span class="stat-label">Active Resellers</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">99.9%</span>
                            <span class="stat-label">Server Uptime</span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-value">24/7</span>
                            <span class="stat-label">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Become a Reseller Section -->
<section class="reseller-benefits-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Why Become a <span class="text-gradient">BestLiveIPTV Reseller?</span></h2>
            <p class="section-subtitle">
                Join our successful reseller network and build a profitable IPTV business
            </p>
        </div>
        
        <div class="benefits-grid">
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="0">
                <div class="benefit-icon">
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <h3 class="benefit-title">High Profit Margins</h3>
                <p class="benefit-desc">
                    Set your own prices and earn up to 60% profit on every sale. 
                    With our wholesale rates, your earning potential is unlimited.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="100">
                <div class="benefit-icon cyan">
                    <i class="ph-fill ph-desktop-tower"></i>
                </div>
                <h3 class="benefit-title">White Label Panel</h3>
                <p class="benefit-desc">
                    Get a fully branded reseller panel with your own logo and domain. 
                    Your customers will never know we're behind the scenes.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="200">
                <div class="benefit-icon green">
                    <i class="ph-fill ph-lightning"></i>
                </div>
                <h3 class="benefit-title">Instant Delivery</h3>
                <p class="benefit-desc">
                    Create subscriptions instantly with our automated panel. 
                    Your customers get their credentials immediately after purchase.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="300">
                <div class="benefit-icon purple">
                    <i class="ph-fill ph-chart-pie-slice"></i>
                </div>
                <h3 class="benefit-title">Easy Credit System</h3>
                <p class="benefit-desc">
                    Our simple credit-based system makes it easy to manage subscriptions. 
                    Buy credits in bulk and create subs anytime you want.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="400">
                <div class="benefit-icon orange">
                    <i class="ph-fill ph-headset"></i>
                </div>
                <h3 class="benefit-title">24/7 Support</h3>
                <p class="benefit-desc">
                    Get dedicated reseller support around the clock. 
                    We're always here to help you grow your business.
                </p>
            </div>
            
            <div class="benefit-card" data-aos="fade-up" data-aos-delay="500">
                <div class="benefit-icon">
                    <i class="ph-fill ph-shield-checkered"></i>
                </div>
                <h3 class="benefit-title">Premium Content</h3>
                <p class="benefit-desc">
                    Offer 20,000+ channels and 50,000+ VOD in HD/4K quality. 
                    Give your customers the best streaming experience.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="reseller-steps-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Start Your Business in <span class="text-gradient">3 Easy Steps</span></h2>
            <p class="section-subtitle">
                Getting started as a reseller is quick and simple
            </p>
        </div>
        
        <div class="steps-grid">
            <div class="step-card" data-aos="fade-up" data-aos-delay="0">
                <div class="step-number">
                    <span>01</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-shopping-cart-simple"></i>
                </div>
                <h3 class="step-title">Purchase Credits</h3>
                <p class="step-desc">Choose a reseller package and purchase credits. More credits = better pricing per subscription.</p>
            </div>
            
            <div class="step-connector">
                <div class="connector-line"></div>
                <div class="connector-arrow"><i class="ph-bold ph-arrow-right"></i></div>
            </div>
            
            <div class="step-card" data-aos="fade-up" data-aos-delay="200">
                <div class="step-number">
                    <span>02</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-user-plus"></i>
                </div>
                <h3 class="step-title">Create Subscriptions</h3>
                <p class="step-desc">Use our easy panel to create and manage subscriptions for your customers instantly.</p>
            </div>
            
            <div class="step-connector">
                <div class="connector-line"></div>
                <div class="connector-arrow"><i class="ph-bold ph-arrow-right"></i></div>
            </div>
            
            <div class="step-card" data-aos="fade-up" data-aos-delay="400">
                <div class="step-number">
                    <span>03</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-money"></i>
                </div>
                <h3 class="step-title">Earn Profits</h3>
                <p class="step-desc">Sell at your own price and keep the profits! Your business, your rules.</p>
            </div>
        </div>
    </div>
</section>

<!-- Reseller Packages Section -->
<section class="reseller-packages-section" id="reseller-packages">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Choose Your <span class="text-gradient">Reseller Package</span></h2>
            <p class="section-subtitle">
                Start with any package and scale as your business grows. All credits never expire!
            </p>
        </div>
        
        @if($packages->count() > 0)
        <div class="reseller-packages-grid" data-aos="fade-up" data-aos-delay="100">
            @foreach($packages as $package)
            <div class="reseller-pricing-card {{ $package->is_popular ? 'popular' : '' }}">
                @if($package->is_popular)
                <div class="popular-badge">
                    <i class="ph-fill ph-crown"></i>
                    Best Value
                </div>
                @endif
                
                <div class="pricing-header">
                    <h3 class="plan-name">{{ $package->name }}</h3>
                    <p class="plan-credits">Credits Package</p>
                </div>
                
                <div class="pricing-price">
                    <span class="current-price">
                        <span class="currency">$</span>
                        <span class="amount">{{ number_format($package->price, 0) }}</span>
                    </span>
                    <span class="period">one-time</span>
                </div>
                
                <ul class="pricing-features">
                    @foreach($package->features as $feature)
                        <li><i class="ph-fill ph-check-circle"></i> {{ $feature->name }}</li>
                    @endforeach
                    @if($package->features->isEmpty())
                        <li><i class="ph-fill ph-check-circle"></i> Full Reseller Panel Access</li>
                        <li><i class="ph-fill ph-check-circle"></i> Unlimited Trial Accounts</li>
                        <li><i class="ph-fill ph-check-circle"></i> 24/7 Priority Support</li>
                        <li><i class="ph-fill ph-check-circle"></i> Credits Never Expire</li>
                        <li><i class="ph-fill ph-check-circle"></i> White Label Branding</li>
                        <li><i class="ph-fill ph-check-circle"></i> Detailed Analytics</li>
                    @endif
                </ul>
                
                <a href="{{ route('checkout.show', $package->slug) }}" class="btn {{ $package->is_popular ? 'btn-primary' : 'btn-outline' }} btn-block">
                    <i class="ph ph-shopping-cart"></i>
                    Get Started
                </a>
            </div>
            @endforeach
        </div>
        @else
        <!-- Empty State - No Packages Available -->
        <div class="empty-packages-state" data-aos="fade-up">
            <div class="empty-state-card">
                <div class="empty-state-icon">
                    <i class="ph-duotone ph-package"></i>
                </div>
                <h3 class="empty-state-title">No Reseller Packages Available</h3>
                <p class="empty-state-desc">
                    We're currently setting up our reseller packages. 
                    Please check back soon or contact us for custom reseller options.
                </p>
                <div class="empty-state-actions">
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                        <i class="ph ph-chat-circle-text"></i>
                        Contact Us
                    </a>
                    <a href="{{ route('home') }}" class="btn btn-outline btn-lg">
                        <i class="ph ph-house"></i>
                        Back to Home
                    </a>
                </div>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- FAQ Section -->
<section class="reseller-faq-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Reseller <span class="text-gradient">FAQ</span></h2>
            <p class="section-subtitle">
                Common questions from our resellers
            </p>
        </div>
        
        <div class="faq-grid" data-aos="fade-up" data-aos-delay="100">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How does the credit system work?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Each subscription requires a certain number of credits. For example, 1 month = 1 credit, 3 months = 2 credits, etc. You purchase credits in bulk at wholesale prices and use them to create subscriptions for your customers. The more credits you buy, the lower the cost per credit!</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do credits expire?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>No! Your credits never expire. You can use them whenever you want, at your own pace. This gives you complete flexibility to grow your business.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Can I set my own prices?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely! You have complete freedom to set any price you want for your customers. Many of our resellers sell subscriptions at 50-100% markup, keeping all the profits.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Is the reseller panel white-labeled?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes! Our reseller panel is fully white-labeled. Your customers will never see our branding. You can add your own logo, domain, and customize the look and feel.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What support do resellers get?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>All resellers get 24/7 priority support via our dedicated reseller support channel. We also provide training, marketing materials, and technical assistance to help you succeed.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How quickly can I start selling?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Immediately! Once you purchase credits, you'll get instant access to your reseller panel. You can start creating and selling subscriptions right away.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="reseller-cta-section">
    <div class="container">
        <div class="cta-card" data-aos="fade-up">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Start Your IPTV Business?</h2>
                <p class="cta-desc">Join hundreds of successful resellers who are earning with BestLiveIPTV. Get started today!</p>
                <div class="cta-buttons">
                    <a href="#reseller-packages" class="btn btn-white btn-lg">
                        <i class="ph ph-rocket-launch"></i>
                        Get Started Now
                    </a>
                    <a href="{{ route('contact') }}" class="btn btn-glass-white btn-lg">
                        <i class="ph ph-whatsapp-logo"></i>
                        Contact Support
                    </a>
                </div>
            </div>
            <div class="cta-visual">
                <div class="cta-icon">
                    <i class="ph-fill ph-handshake"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
/* Reseller Stats Card in Hero */
.reseller-stats-card {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-2xl);
    padding: 2rem;
    width: 100%;
    max-width: 420px;
}

.reseller-stats-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    margin-bottom: 1.5rem;
    color: var(--white);
    font-weight: 600;
}

.reseller-stats-header .stats-icon {
    width: 40px;
    height: 40px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.reseller-stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem;
}

.reseller-stats-grid .stat-item {
    text-align: center;
    padding: 1rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: var(--radius-lg);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.reseller-stats-grid .stat-value {
    display: block;
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--secondary-400);
    margin-bottom: 0.25rem;
}

.reseller-stats-grid .stat-label {
    font-size: 0.8125rem;
    color: rgba(255, 255, 255, 0.7);
}

/* Benefits Section */
.reseller-benefits-section {
    padding: 5rem 0;
    background: var(--gray-50);
}

.benefits-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

.benefit-card {
    background: var(--white);
    padding: 2rem;
    border-radius: var(--radius-xl);
    border: 1px solid var(--gray-100);
    transition: all var(--transition-base);
}

.benefit-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
    border-color: transparent;
}

.benefit-icon {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: var(--white);
    margin-bottom: 1.25rem;
}

.benefit-icon.cyan {
    background: linear-gradient(135deg, var(--secondary-500), var(--secondary-600));
}

.benefit-icon.green {
    background: linear-gradient(135deg, #10b981, #059669);
}

.benefit-icon.purple {
    background: linear-gradient(135deg, #8b5cf6, #6d28d9);
}

.benefit-icon.orange {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.benefit-title {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 0.75rem;
}

.benefit-desc {
    font-size: 0.9375rem;
    color: var(--gray-600);
    line-height: 1.6;
}

/* Steps Section */
.reseller-steps-section {
    padding: 5rem 0;
    background: var(--white);
}

/* Reseller Packages Section */
.reseller-packages-section {
    padding: 5rem 0 6rem;
    background: linear-gradient(180deg, var(--gray-50) 0%, var(--white) 100%);
}

.reseller-packages-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
    max-width: 1000px;
    margin: 0 auto;
}

.reseller-pricing-card {
    position: relative;
    background: var(--white);
    border-radius: var(--radius-xl);
    padding: 2rem;
    border: 1px solid var(--gray-200);
    transition: all var(--transition-base);
}

.reseller-pricing-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-xl);
}

.reseller-pricing-card.popular {
    background: linear-gradient(180deg, var(--gray-900) 0%, var(--black) 100%);
    border-color: transparent;
    transform: scale(1.05);
}

.reseller-pricing-card.popular:hover {
    transform: scale(1.05) translateY(-10px);
}

.reseller-pricing-card.popular .plan-name,
.reseller-pricing-card.popular .plan-credits,
.reseller-pricing-card.popular .pricing-features li,
.reseller-pricing-card.popular .current-price,
.reseller-pricing-card.popular .period {
    color: var(--white);
}

.reseller-pricing-card.popular .pricing-features i {
    color: var(--secondary-400);
}

.custom-package-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 2rem;
    padding: 1rem;
    background: var(--primary-50);
    border-radius: var(--radius-lg);
    font-size: 0.9375rem;
    color: var(--gray-700);
}

.custom-package-note i {
    font-size: 1.25rem;
    color: var(--primary-600);
}

.custom-package-note a {
    color: var(--primary-600);
    font-weight: 600;
    text-decoration: underline;
}

/* FAQ Section */
.reseller-faq-section {
    padding: 5rem 0;
    background: var(--gray-50);
}

/* CTA Section */
.reseller-cta-section {
    padding: 5rem 0 6rem;
    background: var(--white);
}

.cta-card {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 3rem;
    background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-700) 100%);
    border-radius: var(--radius-2xl);
    padding: 4rem;
    position: relative;
    overflow: hidden;
}

.cta-card::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 60%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.cta-content {
    position: relative;
    z-index: 1;
    flex: 1;
}

.cta-title {
    font-family: var(--font-display);
    font-size: 2.25rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 0.75rem;
}

.cta-desc {
    font-size: 1.125rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 2rem;
    max-width: 500px;
}

.cta-buttons {
    display: flex;
    gap: 1rem;
}

.btn-white {
    background: var(--white);
    color: var(--primary-600);
    font-weight: 600;
}

.btn-white:hover {
    background: var(--gray-100);
    transform: translateY(-2px);
}

.btn-glass-white {
    background: rgba(255, 255, 255, 0.15);
    color: var(--white);
    border: 1px solid rgba(255, 255, 255, 0.3);
    backdrop-filter: blur(10px);
}

.btn-glass-white:hover {
    background: rgba(255, 255, 255, 0.25);
}

/* Empty State Styling */
.empty-state-card {
    text-align: center;
    padding: 4rem 2rem;
    background: var(--white);
    border-radius: var(--radius-2xl);
    border: 1px solid var(--gray-200);
    max-width: 600px;
    margin: 0 auto;
}

.empty-state-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, var(--primary-50), var(--primary-100));
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--primary-600);
    margin: 0 auto 1.5rem;
}

.empty-state-title {
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: 0.75rem;
}

.empty-state-desc {
    font-size: 1.0625rem;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 2rem;
    max-width: 450px;
    margin-left: auto;
    margin-right: auto;
}

.empty-state-actions {
    display: flex;
    gap: 1rem;
    justify-content: center;
    flex-wrap: wrap;
}

.cta-visual {
    position: relative;
    z-index: 1;
}

.cta-icon {
    width: 140px;
    height: 140px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-2xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 4rem;
    color: var(--white);
}

/* Responsive */
@media (max-width: 1024px) {
    .benefits-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .reseller-packages-grid {
        grid-template-columns: 1fr;
        max-width: 400px;
    }
    
    .reseller-pricing-card.popular {
        transform: none;
    }
    
    .reseller-pricing-card.popular:hover {
        transform: translateY(-10px);
    }
}

@media (max-width: 768px) {
    .page-hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }
    
    .page-hero-text {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    
    .page-hero-features {
        justify-content: center;
    }
    
    .hero-cta {
        flex-direction: column;
        width: 100%;
    }
    
    .hero-cta .btn {
        width: 100%;
    }
    
    .reseller-stats-card {
        max-width: 100%;
    }
    
    .benefits-grid {
        grid-template-columns: 1fr;
    }
    
    .steps-grid {
        flex-direction: column;
    }
    
    .step-connector {
        transform: rotate(90deg);
        margin: 1rem 0;
    }
    
    .cta-card {
        flex-direction: column;
        text-align: center;
        padding: 2.5rem;
    }
    
    .cta-content {
        text-align: center;
    }
    
    .cta-desc {
        margin-left: auto;
        margin-right: auto;
    }
    
    .cta-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .cta-buttons .btn {
        width: 100%;
    }
}
</style>
@endsection
