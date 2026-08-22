@extends('layouts.app')

@section('title', 'Frequently Asked Questions - BestLiveIPTV')

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
                    Frequently Asked <span class="text-gradient">Questions</span>
                </h1>
                
                <p class="page-hero-subtitle">
                    Find answers to common questions about our IPTV service, 
                    setup guides, payment options, and technical support.
                </p>
                
                <div class="page-hero-features">
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-book-open"></i>
                        <span>Setup Guides</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-credit-card"></i>
                        <span>Billing Help</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-headset"></i>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
            
            <div class="page-hero-visual" data-aos="fade-left" data-aos-delay="200">
                <div class="page-hero-image">
                    <div class="page-hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop" 
                             alt="FAQ Help Center" 
                             class="page-hero-img"
                             loading="lazy">
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-1">
                        <div class="page-hero-floating-icon blue">
                            <i class="ph-fill ph-book-open"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">50+</span>
                            <span class="page-hero-floating-label">Articles</span>
                        </div>
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-2">
                        <div class="page-hero-floating-icon green">
                            <i class="ph-fill ph-check-circle"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">24/7</span>
                            <span class="page-hero-floating-label">Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-page-section">
    <div class="container">
        <div class="faq-content">
            <!-- FAQ Categories -->
            <div class="faq-sidebar" data-aos="fade-right">
                <h3 class="sidebar-title">Categories</h3>
                <ul class="category-list">
                    <li><a href="#general" class="active"><i class="ph ph-info"></i> General</a></li>
                    <li><a href="#setup"><i class="ph ph-gear"></i> Setup & Installation</a></li>
                    <li><a href="#payment"><i class="ph ph-credit-card"></i> Payment & Billing</a></li>
                    <li><a href="#technical"><i class="ph ph-wrench"></i> Technical Support</a></li>
                </ul>
                
                <div class="sidebar-cta">
                    <i class="ph-fill ph-headset"></i>
                    <h4>Still Need Help?</h4>
                    <p>Our support team is available 24/7</p>
                    <a href="{{ route('contact') }}" class="btn btn-primary btn-sm btn-block">Contact Support</a>
                </div>
            </div>
            
            <!-- FAQ List -->
            <div class="faq-main" data-aos="fade-left">
                <!-- General -->
                <div class="faq-category" id="general">
                    <h2 class="category-title">
                        <i class="ph-fill ph-info"></i>
                        General Questions
                    </h2>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>What is IPTV and how does it work?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>IPTV (Internet Protocol Television) is a service that delivers television content over the internet rather than through traditional satellite or cable formats. Instead of receiving TV programs as broadcast signals through an antenna, satellite dish, or fiber-optic cable, you stream content directly through your internet connection. Our service works with any device that has an internet connection, making it extremely versatile and convenient.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>What channels and content do you offer?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>We offer over 20,000 live TV channels from around the world including sports, movies, news, entertainment, kids, and more. Additionally, we provide access to 50,000+ Video on Demand (VOD) content including the latest movies and TV series. Our content is available in multiple languages and from over 150 countries.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Is there a free trial available?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes! We offer a 36-hour free trial so you can test our service before committing to a subscription. The trial includes full access to all channels, VOD content, and features. This allows you to verify compatibility with your devices and ensure our service meets your expectations.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>How many devices can I use simultaneously?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>The number of simultaneous connections depends on your subscription plan. We offer plans ranging from 1 to 4+ devices. For example, a 2-device plan allows you to stream on two different devices at the same time, making it perfect for family use.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Setup & Installation -->
                <div class="faq-category" id="setup">
                    <h2 class="category-title">
                        <i class="ph-fill ph-gear"></i>
                        Setup & Installation
                    </h2>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>What devices are compatible with your service?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Our service is compatible with a wide range of devices including: Smart TVs (Samsung, LG, Sony, etc.), Android devices (phones, tablets, TV boxes), iOS devices (iPhone, iPad), Amazon Fire Stick, Nvidia Shield, MAG boxes, Windows and Mac computers, Xbox, and most IPTV players and apps. We provide detailed setup guides for all devices.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>What internet speed do I need?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>For optimal streaming experience, we recommend: SD quality: 5 Mbps minimum, HD quality: 10 Mbps minimum, Full HD (1080p): 15 Mbps minimum, 4K Ultra HD: 25 Mbps minimum. A stable wired connection is preferred over WiFi for the best experience, especially for 4K content.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>How quickly will I receive my subscription?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>After successful payment, you will receive your subscription details instantly via email. In most cases, you can start watching within minutes of completing your purchase. Our automated system ensures immediate delivery 24/7.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Do you provide setup assistance?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes, we provide comprehensive setup guides for all devices and our support team is available 24/7 to assist you with installation. We can even provide remote assistance if needed to ensure you get up and running smoothly.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Payment & Billing -->
                <div class="faq-category" id="payment">
                    <h2 class="category-title">
                        <i class="ph-fill ph-credit-card"></i>
                        Payment & Billing
                    </h2>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>What payment methods do you accept?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>We accept multiple payment methods including: PayPal (fastest and most secure), Credit/Debit cards via Stripe (Visa, Mastercard, American Express), and Cryptocurrencies (Bitcoin, Ethereum, and other major coins). All payments are processed securely with 256-bit SSL encryption.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Do subscriptions auto-renew?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>No, our subscriptions do not auto-renew. You have full control over your subscription and can renew manually when you're ready. We'll send you a reminder email before your subscription expires so you can decide whether to renew.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>What is your refund policy?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>We offer a 24-hour money-back guarantee for new subscribers. If you're not satisfied with our service within the first 24 hours of activation, contact our support team for a full refund. Please note that refunds are not available for renewal subscriptions.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Can I upgrade my plan?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Yes, you can upgrade your plan at any time. Contact our support team and we'll help you upgrade to a higher tier plan. The upgrade cost will be prorated based on your remaining subscription time.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Technical Support -->
                <div class="faq-category" id="technical">
                    <h2 class="category-title">
                        <i class="ph-fill ph-wrench"></i>
                        Technical Support
                    </h2>
                    
                    <div class="faq-list">
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Why is my stream buffering or freezing?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Buffering is usually caused by internet connection issues. Try these steps: 1) Check your internet speed, 2) Use a wired connection instead of WiFi, 3) Restart your router, 4) Close other apps using bandwidth, 5) Try a lower quality stream. If issues persist, contact our support team for assistance.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>A channel is not working. What should I do?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>If a specific channel isn't working, try refreshing the playlist first. If the issue persists, it could be a temporary server issue or the channel might be under maintenance. Report the issue to our support team with the channel name and we'll resolve it as quickly as possible.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>Do I need a VPN to use your service?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>A VPN is not required to use our service, but we recommend using one for added privacy and to prevent ISP throttling. Some ISPs may limit streaming bandwidth, and a VPN can help bypass these restrictions. We recommend VPN services that offer fast speeds and don't log user activity.</p>
                            </div>
                        </div>
                        
                        <div class="faq-item">
                            <button class="faq-question">
                                <span>How do I contact customer support?</span>
                                <i class="ph ph-plus"></i>
                            </button>
                            <div class="faq-answer">
                                <p>Our customer support team is available 24/7 through multiple channels: Email (support@bestliveiptv.com), WhatsApp, Telegram (@BestLiveIPTV), and our website contact form. We typically respond within minutes for urgent issues and within a few hours for general inquiries.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="faq-cta-section">
    <div class="container">
        <div class="cta-box" data-aos="fade-up">
            <div class="cta-content">
                <h2>Didn't Find Your Answer?</h2>
                <p>Our support team is ready to help you with any questions</p>
            </div>
            <div class="cta-actions">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">
                    <i class="ph ph-chat-centered-dots"></i>
                    Contact Support
                </a>
                <a href="{{ route('packages.index') }}?duration=trial" class="btn btn-outline btn-lg">
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
        line-height: 1.7;
    }
    
    .faq-page-section {
        padding: 4rem 0;
        background: var(--gray-50);
    }
    
    .faq-content {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 3rem;
        align-items: start;
    }
    
    .faq-sidebar {
        position: sticky;
        top: 150px;
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
    }
    
    .sidebar-title {
        font-family: var(--font-display);
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .category-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-bottom: 2rem;
    }
    
    .category-list a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        font-size: 0.9375rem;
        color: var(--gray-600);
        border-radius: var(--radius-lg);
        transition: var(--transition-base);
    }
    
    .category-list a i {
        font-size: 1.125rem;
    }
    
    .category-list a:hover,
    .category-list a.active {
        background: var(--primary-50);
        color: var(--primary-600);
    }
    
    .sidebar-cta {
        text-align: center;
        padding: 1.5rem;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
    }
    
    .sidebar-cta i {
        font-size: 2.5rem;
        color: var(--primary-500);
        margin-bottom: 0.75rem;
    }
    
    .sidebar-cta h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .sidebar-cta p {
        font-size: 0.8125rem;
        color: var(--gray-500);
        margin-bottom: 1rem;
    }
    
    .faq-main {
        display: flex;
        flex-direction: column;
        gap: 3rem;
    }
    
    .faq-category {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
    }
    
    .category-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .category-title i {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gradient-primary);
        color: var(--white);
        border-radius: var(--radius-lg);
        font-size: 1.125rem;
    }
    
    .faq-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    /* FAQ CTA */
    .faq-cta-section {
        padding: 4rem 0;
        background: var(--white);
    }
    
    .cta-box {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        padding: 3rem;
        background: var(--gradient-primary);
        border-radius: var(--radius-2xl);
        color: var(--white);
    }
    
    .cta-box h2 {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .cta-box p {
        opacity: 0.9;
    }
    
    .cta-actions {
        display: flex;
        gap: 1rem;
    }
    
    .cta-actions .btn-outline {
        border-color: var(--white);
        color: var(--white);
    }
    
    .cta-actions .btn-outline:hover {
        background: var(--white);
        color: var(--primary-600);
    }
    
    @media (max-width: 1024px) {
        .faq-content {
            grid-template-columns: 1fr;
        }
        
        .faq-sidebar {
            position: static;
        }
        
        .category-list {
            flex-direction: row;
            flex-wrap: wrap;
        }
    }
    
    @media (max-width: 768px) {
        .page-hero {
            padding: 140px 0 60px;
        }
        
        .faq-category {
            padding: 1.5rem;
        }
        
        .cta-box {
            flex-direction: column;
            text-align: center;
            padding: 2rem;
        }
        
        .cta-actions {
            flex-direction: column;
            width: 100%;
        }
        
        .cta-actions .btn {
            width: 100%;
        }
    }
</style>
@endpush
@endsection
