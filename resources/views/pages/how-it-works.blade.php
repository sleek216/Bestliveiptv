@extends('layouts.app')

@section('title', 'How It Works - BestLiveIPTV')

@section('content')
<!-- Page Hero -->
<section class="page-hero">
    <div class="hero-bg">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
    </div>
    <div class="container">
        <div class="page-hero-content" data-aos="fade-up">
            <span class="section-badge">
                <i class="ph-fill ph-question"></i>
                Getting Started
            </span>
            <h1 class="page-title">How It <span class="text-gradient">Works</span></h1>
            <p class="page-subtitle">
                Get started with BestLiveIPTV in just a few simple steps
            </p>
        </div>
    </div>
</section>

<!-- Steps Section -->
<section class="steps-section">
    <div class="container">
        <div class="steps-timeline">
            <!-- Step 1 -->
            <div class="step-item" data-aos="fade-up">
                <div class="step-content">
                    <div class="step-number">01</div>
                    <h3>Choose Your Plan</h3>
                    <p>Browse our subscription plans and select the one that best fits your needs. We offer plans for individuals and families with various durations from 1 month to 12 months.</p>
                    <ul class="step-features">
                        <li><i class="ph-fill ph-check"></i> 1 to 4 device connections</li>
                        <li><i class="ph-fill ph-check"></i> Flexible duration options</li>
                        <li><i class="ph-fill ph-check"></i> Free trial available</li>
                    </ul>
                    <a href="{{ route('packages.index') }}" class="btn btn-primary">
                        <i class="ph ph-package"></i>
                        View Plans
                    </a>
                </div>
                <div class="step-visual">
                    <div class="visual-box">
                        <i class="ph-fill ph-package"></i>
                    </div>
                </div>
            </div>
            
            <!-- Step 2 -->
            <div class="step-item reverse" data-aos="fade-up">
                <div class="step-content">
                    <div class="step-number">02</div>
                    <h3>Complete Your Order</h3>
                    <p>Enter your details and complete the secure checkout process. We accept multiple payment methods including PayPal, credit cards, and cryptocurrency for your convenience.</p>
                    <ul class="step-features">
                        <li><i class="ph-fill ph-check"></i> Secure SSL checkout</li>
                        <li><i class="ph-fill ph-check"></i> Multiple payment options</li>
                        <li><i class="ph-fill ph-check"></i> Instant confirmation</li>
                    </ul>
                </div>
                <div class="step-visual">
                    <div class="visual-box">
                        <i class="ph-fill ph-credit-card"></i>
                    </div>
                </div>
            </div>
            
            <!-- Step 3 -->
            <div class="step-item" data-aos="fade-up">
                <div class="step-content">
                    <div class="step-number">03</div>
                    <h3>Receive Your Credentials</h3>
                    <p>After payment, you'll instantly receive your IPTV credentials via email. This includes your username, password, and portal URL needed to access the service.</p>
                    <ul class="step-features">
                        <li><i class="ph-fill ph-check"></i> Instant email delivery</li>
                        <li><i class="ph-fill ph-check"></i> Portal URL & login details</li>
                        <li><i class="ph-fill ph-check"></i> Setup instructions included</li>
                    </ul>
                </div>
                <div class="step-visual">
                    <div class="visual-box">
                        <i class="ph-fill ph-envelope"></i>
                    </div>
                </div>
            </div>
            
            <!-- Step 4 -->
            <div class="step-item reverse" data-aos="fade-up">
                <div class="step-content">
                    <div class="step-number">04</div>
                    <h3>Install an IPTV App</h3>
                    <p>Download and install an IPTV player app on your device. We support popular apps like IPTV Smarters, TiviMate, VLC, and many more across all platforms.</p>
                    <ul class="step-features">
                        <li><i class="ph-fill ph-check"></i> Free IPTV apps available</li>
                        <li><i class="ph-fill ph-check"></i> Works on all devices</li>
                        <li><i class="ph-fill ph-check"></i> Easy installation guides</li>
                    </ul>
                </div>
                <div class="step-visual">
                    <div class="visual-box">
                        <i class="ph-fill ph-download-simple"></i>
                    </div>
                </div>
            </div>
            
            <!-- Step 5 -->
            <div class="step-item" data-aos="fade-up">
                <div class="step-content">
                    <div class="step-number">05</div>
                    <h3>Start Watching!</h3>
                    <p>Enter your credentials in the IPTV app, and you're ready to enjoy 20,000+ live channels and 50,000+ VOD content in crystal clear HD & 4K quality.</p>
                    <ul class="step-features">
                        <li><i class="ph-fill ph-check"></i> 20,000+ live channels</li>
                        <li><i class="ph-fill ph-check"></i> 50,000+ movies & series</li>
                        <li><i class="ph-fill ph-check"></i> HD & 4K streaming</li>
                    </ul>
                    <a href="{{ route('channels') }}" class="btn btn-primary">
                        <i class="ph ph-television"></i>
                        View Channels
                    </a>
                </div>
                <div class="step-visual">
                    <div class="visual-box">
                        <i class="ph-fill ph-play-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Devices Section -->
<section class="devices-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <span class="section-badge">
                <i class="ph-fill ph-devices"></i>
                Compatibility
            </span>
            <h2>Works on All Your Devices</h2>
            <p>Our service is compatible with a wide range of devices and platforms</p>
        </div>
        
        <div class="devices-grid">
            <div class="device-card" data-aos="fade-up">
                <i class="ph-fill ph-television"></i>
                <h4>Smart TV</h4>
                <p>Samsung, LG, Sony, Android TV</p>
            </div>
            <div class="device-card" data-aos="fade-up" data-aos-delay="50">
                <i class="ph-fill ph-device-mobile"></i>
                <h4>Mobile</h4>
                <p>Android phones & tablets</p>
            </div>
            <div class="device-card" data-aos="fade-up" data-aos-delay="100">
                <i class="ph-fill ph-apple-logo"></i>
                <h4>iOS</h4>
                <p>iPhone & iPad</p>
            </div>
            <div class="device-card" data-aos="fade-up" data-aos-delay="150">
                <i class="ph-fill ph-flame"></i>
                <h4>Fire Stick</h4>
                <p>Amazon Fire TV devices</p>
            </div>
            <div class="device-card" data-aos="fade-up" data-aos-delay="200">
                <i class="ph-fill ph-desktop"></i>
                <h4>Computer</h4>
                <p>Windows & Mac</p>
            </div>
            <div class="device-card" data-aos="fade-up" data-aos-delay="250">
                <i class="ph-fill ph-game-controller"></i>
                <h4>MAG Box</h4>
                <p>MAG 250, 254, 322, etc.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-mini-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2>Common Questions</h2>
        </div>
        
        <div class="faq-grid" data-aos="fade-up">
            <div class="faq-item">
                <button class="faq-question">
                    <span>How quickly can I start watching?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>You can start watching within minutes of completing your purchase. Your credentials are delivered instantly via email.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What internet speed do I need?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>We recommend at least 10 Mbps for HD streaming and 25 Mbps for 4K content. A stable connection is more important than raw speed.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do you provide setup help?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes! We provide detailed setup guides for all devices, and our 24/7 support team can assist you with remote setup if needed.</p>
                </div>
            </div>
        </div>
        
        <div class="faq-more" data-aos="fade-up">
            <a href="{{ route('faq') }}" class="btn btn-outline">
                View All FAQs
                <i class="ph ph-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="how-cta">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of satisfied customers enjoying premium entertainment</p>
            <div class="cta-buttons">
                <a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg">
                    <i class="ph ph-shopping-cart"></i>
                    View Plans
                </a>
                <a href="{{ route('packages.index') }}?duration=trial" class="btn btn-white btn-lg">
                    <i class="ph ph-play-circle"></i>
                    Try Free Trial
                </a>
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
    }
    
    .steps-section {
        padding: 5rem 0;
        background: var(--gray-50);
    }
    
    .steps-timeline {
        max-width: 1000px;
        margin: 0 auto;
    }
    
    .step-item {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        margin-bottom: 4rem;
    }
    
    .step-item.reverse {
        direction: rtl;
    }
    
    .step-item.reverse > * {
        direction: ltr;
    }
    
    .step-content {
        padding: 2rem;
        background: var(--white);
        border-radius: var(--radius-2xl);
        box-shadow: var(--shadow-lg);
    }
    
    .step-number {
        font-family: var(--font-display);
        font-size: 3rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
    }
    
    .step-content h3 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }
    
    .step-content p {
        color: var(--gray-600);
        line-height: 1.7;
        margin-bottom: 1.5rem;
    }
    
    .step-features {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .step-features li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9375rem;
        color: var(--gray-700);
    }
    
    .step-features li i {
        color: var(--success-500);
    }
    
    .step-visual {
        display: flex;
        justify-content: center;
    }
    
    .visual-box {
        width: 200px;
        height: 200px;
        background: var(--gradient-primary);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .visual-box i {
        font-size: 5rem;
        color: var(--white);
    }
    
    .devices-section {
        padding: 5rem 0;
        background: var(--white);
    }
    
    .devices-section .section-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .devices-section h2 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .devices-section p {
        color: var(--gray-500);
    }
    
    .devices-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 1.5rem;
    }
    
    .device-card {
        text-align: center;
        padding: 2rem 1rem;
        background: var(--gray-50);
        border-radius: var(--radius-xl);
        transition: var(--transition-base);
    }
    
    .device-card:hover {
        background: var(--primary-50);
        transform: translateY(-4px);
    }
    
    .device-card i {
        font-size: 2.5rem;
        color: var(--primary-500);
        margin-bottom: 1rem;
    }
    
    .device-card h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .device-card p {
        font-size: 0.75rem;
        color: var(--gray-500);
    }
    
    .faq-mini-section {
        padding: 5rem 0;
        background: var(--gray-50);
    }
    
    .faq-mini-section .section-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .faq-mini-section h2 {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
    }
    
    .faq-grid {
        max-width: 800px;
        margin: 0 auto;
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .faq-more {
        text-align: center;
        margin-top: 2rem;
    }
    
    .how-cta {
        padding: 5rem 0;
        background: var(--gradient-primary);
        text-align: center;
        color: var(--white);
    }
    
    .how-cta h2 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    
    .how-cta p {
        font-size: 1.125rem;
        opacity: 0.9;
        margin-bottom: 2rem;
    }
    
    .cta-buttons {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .btn-white {
        background: var(--white);
        color: var(--primary-600);
    }
    
    .btn-white:hover {
        background: var(--gray-100);
    }
    
    @media (max-width: 1024px) {
        .devices-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .page-hero {
            padding: 140px 0 60px;
        }
        
        .step-item {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .step-item.reverse {
            direction: ltr;
        }
        
        .visual-box {
            width: 150px;
            height: 150px;
        }
        
        .visual-box i {
            font-size: 4rem;
        }
        
        .devices-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .cta-buttons {
            flex-direction: column;
        }
        
        .cta-buttons .btn {
            width: 100%;
        }
    }
</style>
@endpush
@endsection
