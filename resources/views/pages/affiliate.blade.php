@extends('layouts.app')

@section('title', 'Affiliate Program - BestLiveIPTV')

@section('content')
<!-- Hero Section -->
<section class="page-hero">
    <div class="page-hero-bg">
        <div class="page-hero-pattern"></div>
        <div class="page-hero-glow page-hero-glow-1"></div>
        <div class="page-hero-glow page-hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="page-hero-content">
            <div class="page-hero-text" data-aos="fade-right" data-aos-duration="800">
                <h1 class="page-hero-title">
                    Earn Money as Our <span class="text-gradient">Affiliate Partner</span>
                </h1>
                <p class="page-hero-subtitle">
                    Join our affiliate program and earn generous <strong>20% commission</strong> on every successful referral. 
                    No limits, no caps – the more you refer, the more you earn!
                </p>
                <div class="page-hero-features">
                    <div class="page-hero-feature">
                        <span>20% Commission</span>
                    </div>
                    <div class="page-hero-feature">
                        <span>Lifetime Tracking</span>
                    </div>
                    <div class="page-hero-feature">
                        <span>Fast Payouts</span>
                    </div>
                </div>
                <div class="hero-cta" style="margin-top: 2rem;">
                    @auth
                        <a href="{{ route('profile') }}#affiliate" class="btn btn-primary btn-lg">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            Start Earning Now
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-glass btn-lg">
                            Login
                        </a>
                    @endauth
                </div>
            </div>
            
            <div class="page-hero-visual" data-aos="fade-left" data-aos-duration="800" data-aos-delay="200">
                <div class="page-hero-image">
                    <div class="page-hero-image-wrapper" style="background: linear-gradient(135deg, rgba(0, 102, 255, 0.2), rgba(0, 212, 255, 0.1)); padding: 2rem;">
                        <div style="text-align: center;">
                            <div style="font-size: 5rem; margin-bottom: 1rem;">💰</div>
                            <div style="font-size: 3rem; font-weight: 800; color: #fff; margin-bottom: 0.5rem;">20%</div>
                            <div style="font-size: 1.25rem; color: rgba(255,255,255,0.8); font-weight: 500;">Commission Rate</div>
                            <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(255,255,255,0.1); border-radius: 12px;">
                                <div style="font-size: 0.875rem; color: rgba(255,255,255,0.6); margin-bottom: 0.25rem;">Average Monthly Earnings</div>
                                <div style="font-size: 1.75rem; font-weight: 700; color: #10B981;">$500+</div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-1">
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">Real-Time</span>
                            <span class="page-hero-floating-label">Tracking</span>
                        </div>
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-2">
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">$50</span>
                            <span class="page-hero-floating-label">Min Payout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon">
                    <i class="ph-fill ph-percent"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">20%</span>
                    <span class="stat-label">Commission Rate</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="ph-fill ph-hourglass-medium"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">30</span>
                    <span class="stat-label">Days Cookie Duration</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">$50</span>
                    <span class="stat-label">Minimum Payout</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="ph-fill ph-lightning"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">24h</span>
                    <span class="stat-label">Fast Processing</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="benefits">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Why Join Our <span class="text-gradient">Affiliate Program?</span></h2>
            <p class="section-subtitle">
                Discover the benefits of partnering with the leading IPTV provider
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-currency-dollar"></i>
                </div>
                <h3 class="feature-title">High Commission Rate</h3>
                <p class="feature-desc">Earn a generous 20% commission on every successful sale. With our premium packages, this can mean significant earnings per referral.</p>
                <div class="feature-tags">
                    <span>20% Per Sale</span>
                    <span>No Limits</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-chart-line-up"></i>
                </div>
                <h3 class="feature-title">Real-Time Tracking</h3>
                <p class="feature-desc">Monitor your performance with our advanced dashboard. Track clicks, conversions, and earnings in real-time, anytime.</p>
                <div class="feature-tags">
                    <span>Live Stats</span>
                    <span>Analytics</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-wallet"></i>
                </div>
                <h3 class="feature-title">Fast & Easy Payouts</h3>
                <p class="feature-desc">Withdraw your earnings easily once you reach $50. We support multiple payment methods including Crypto for fast payouts.</p>
                <div class="feature-tags">
                    <span>Crypto</span>
                    <span>Bank Transfer</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-cookie"></i>
                </div>
                <h3 class="feature-title">30-Day Cookie</h3>
                <p class="feature-desc">Our cookies last for 30 days, meaning you'll earn commission even if your referral doesn't purchase immediately.</p>
                <div class="feature-tags">
                    <span>Long Duration</span>
                    <span>More Sales</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-link-simple"></i>
                </div>
                <h3 class="feature-title">Easy Sharing</h3>
                <p class="feature-desc">Get your unique referral link instantly. Share on social media, websites, or directly with friends and family.</p>
                <div class="feature-tags">
                    <span>One Click</span>
                    <span>Easy Share</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-headset"></i>
                </div>
                <h3 class="feature-title">Dedicated Support</h3>
                <p class="feature-desc">Our affiliate support team is here to help you succeed. Get assistance with promotional strategies and materials.</p>
                <div class="feature-tags">
                    <span>24/7 Help</span>
                    <span>Resources</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Start Earning in <span class="text-gradient">3 Easy Steps</span></h2>
            <p class="section-subtitle">
                It's simple to get started and begin earning commissions
            </p>
        </div>
        
        <div class="steps-grid">
            <div class="step-card" data-aos="fade-up" data-aos-delay="0">
                <div class="step-number">
                    <span>01</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-user-plus"></i>
                </div>
                <h3 class="step-title">Create Free Account</h3>
                <p class="step-desc">Sign up for a free account. Your affiliate dashboard is automatically activated with your unique referral link.</p>
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
                    <i class="ph-fill ph-share-network"></i>
                </div>
                <h3 class="step-title">Share Your Link</h3>
                <p class="step-desc">Share your unique referral link with your audience through social media, website, email, or direct messaging.</p>
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
                <h3 class="step-title">Earn 20% Commission</h3>
                <p class="step-desc">When someone purchases through your link, you earn 20% commission. Track earnings and withdraw when you reach $50.</p>
            </div>
        </div>
    </div>
</section>

<!-- Earning Calculator Section -->
<section class="devices-section" style="background: var(--gray-50);">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Calculate Your <span class="text-gradient">Potential Earnings</span></h2>
            <p class="section-subtitle">
                See how much you could earn with our affiliate program
            </p>
        </div>
        
        <div style="max-width: 800px; margin: 0 auto;" data-aos="fade-up" data-aos-delay="200">
            <div style="background: var(--white); border-radius: var(--radius-2xl); padding: 3rem; border: 1px solid var(--gray-100); box-shadow: var(--shadow-lg);">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; text-align: center;">
                    <div>
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0.5rem; font-weight: 500;">Average Package Price</div>
                        <div style="font-size: 2rem; font-weight: 800; color: var(--gray-900);">$50</div>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0.5rem; font-weight: 500;">Your Commission (20%)</div>
                        <div style="font-size: 2rem; font-weight: 800; color: var(--primary-500);">$10</div>
                    </div>
                    <div>
                        <div style="font-size: 0.875rem; color: var(--gray-500); margin-bottom: 0.5rem; font-weight: 500;">10 Sales/Month</div>
                        <div style="font-size: 2rem; font-weight: 800; color: var(--success);">$100</div>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--gray-100);">
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
                        <div style="text-align: center; padding: 1rem; background: var(--gray-50); border-radius: var(--radius-lg);">
                            <div style="font-size: 0.75rem; color: var(--gray-500); margin-bottom: 0.25rem;">5 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900);">$50/mo</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: var(--primary-50); border-radius: var(--radius-lg); border: 2px solid var(--primary-200);">
                            <div style="font-size: 0.75rem; color: var(--primary-600); margin-bottom: 0.25rem;">20 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--primary-600);">$200/mo</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: var(--gray-50); border-radius: var(--radius-lg);">
                            <div style="font-size: 0.75rem; color: var(--gray-500); margin-bottom: 0.25rem;">50 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--gray-900);">$500/mo</div>
                        </div>
                        <div style="text-align: center; padding: 1rem; background: var(--gray-50); border-radius: var(--radius-lg);">
                            <div style="font-size: 0.75rem; color: var(--gray-500); margin-bottom: 0.25rem;">100 Sales</div>
                            <div style="font-size: 1.25rem; font-weight: 700; color: var(--success);">$1000/mo</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
            <p class="section-subtitle">
                Everything you need to know about our affiliate program
            </p>
        </div>
        
        <div class="faq-grid" data-aos="fade-up" data-aos-delay="200">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How much can I earn as an affiliate?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>You earn 20% commission on every sale made through your referral link. There's no cap on earnings – the more customers you refer, the more you earn. Top affiliates earn over $1,000 per month!</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How and when do I get paid?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Once your available balance reaches $50, you can request a payout. We support cryptocurrency (Bitcoin, USDT) and other payment methods. Payouts are processed within 24-48 hours.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How long do cookies last?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Our affiliate cookies last for 30 days. This means if someone clicks your link and makes a purchase within 30 days, you'll receive the commission even if they don't buy immediately.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Is there a cost to join the affiliate program?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>No! Joining our affiliate program is completely free. Simply create an account and you'll automatically get access to your affiliate dashboard and unique referral link.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How do I track my referrals and earnings?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Your affiliate dashboard provides real-time tracking of all your referrals, clicks, conversions, and earnings. You can see detailed statistics and monitor your performance anytime.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Can I promote on social media?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Absolutely! You can share your referral link on social media platforms, YouTube, blogs, forums, or any legitimate marketing channel. Just ensure you follow platform guidelines.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="cta-bg">
        <div class="cta-gradient"></div>
        <div class="cta-pattern"></div>
    </div>
    
    <div class="container">
        <div class="cta-content" data-aos="zoom-in">
            <h2 class="cta-title">Ready to Start <span class="text-gradient">Earning?</span></h2>
            <p class="cta-subtitle">Join thousands of successful affiliates and start earning passive income today!</p>
            
            <div class="cta-features">
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Free to Join</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>20% Commission</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Fast Payouts</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Real-Time Tracking</span>
                </div>
            </div>
            
            <div class="cta-buttons">
                @auth
                    <a href="{{ route('profile') }}#affiliate" class="btn btn-white btn-lg">
                        <i class="ph-fill ph-chart-line-up"></i>
                        Go to Dashboard
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-white btn-lg">
                        <i class="ph-fill ph-rocket-launch"></i>
                        Become an Affiliate
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-white btn-lg">
                        <i class="ph ph-sign-in"></i>
                        Login
                    </a>
                @endauth
            </div>
        </div>
    </div>
</section>
@endsection
