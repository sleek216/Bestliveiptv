@extends('layouts.app')

@section('title', 'Terms of Service - BestLiveIPTV')

@section('content')
<!-- Page Hero -->
<section class="page-hero-small">
    <div class="container">
        <h1 class="page-title">Terms of Service</h1>
        <p class="page-subtitle">Last updated: {{ date('F d, Y') }}</p>
    </div>
</section>

<!-- Content -->
<section class="legal-section">
    <div class="container">
        <div class="legal-content" data-aos="fade-up">
            <div class="legal-nav">
                <h4>Contents</h4>
                <ul>
                    <li><a href="#acceptance">1. Acceptance of Terms</a></li>
                    <li><a href="#services">2. Description of Services</a></li>
                    <li><a href="#accounts">3. User Accounts</a></li>
                    <li><a href="#payments">4. Payments & Billing</a></li>
                    <li><a href="#refunds">5. Refund Policy</a></li>
                    <li><a href="#usage">6. Acceptable Use</a></li>
                    <li><a href="#termination">7. Termination</a></li>
                    <li><a href="#liability">8. Limitation of Liability</a></li>
                    <li><a href="#changes">9. Changes to Terms</a></li>
                    <li><a href="#contact">10. Contact Information</a></li>
                </ul>
            </div>
            
            <div class="legal-main">
                <section id="acceptance">
                    <h2>1. Acceptance of Terms</h2>
                    <p>By accessing or using BestLiveIPTV services, you agree to be bound by these Terms of Service and all applicable laws and regulations. If you do not agree with any of these terms, you are prohibited from using or accessing our services.</p>
                    <p>These terms apply to all users of the service, including without limitation users who are browsers, customers, and contributors of content.</p>
                </section>
                
                <section id="services">
                    <h2>2. Description of Services</h2>
                    <p>BestLiveIPTV provides Internet Protocol Television (IPTV) streaming services that allow users to access live television channels, video-on-demand content, and related entertainment services through an internet connection.</p>
                    <p>Our services include:</p>
                    <ul>
                        <li>Access to live TV channels from around the world</li>
                        <li>Video-on-demand library including movies and TV series</li>
                        <li>Electronic Program Guide (EPG)</li>
                        <li>Multi-device streaming capabilities</li>
                        <li>Customer support services</li>
                    </ul>
                    <p>We reserve the right to modify, suspend, or discontinue any aspect of our services at any time without notice.</p>
                </section>
                
                <section id="accounts">
                    <h2>3. User Accounts</h2>
                    <p>When you create an account with us, you must provide accurate, complete, and current information. Failure to do so constitutes a breach of the Terms.</p>
                    <p>You are responsible for:</p>
                    <ul>
                        <li>Maintaining the confidentiality of your account credentials</li>
                        <li>All activities that occur under your account</li>
                        <li>Notifying us immediately of any unauthorized access</li>
                    </ul>
                    <p>You may not use your account for any illegal or unauthorized purpose, nor may you share your credentials with others beyond the number of connections allowed by your subscription plan.</p>
                </section>
                
                <section id="payments">
                    <h2>4. Payments & Billing</h2>
                    <p>All payments are processed securely through our payment partners. By subscribing to our service, you agree to pay the applicable subscription fees.</p>
                    <p>Key payment terms:</p>
                    <ul>
                        <li>All prices are displayed in USD unless otherwise specified</li>
                        <li>Subscriptions do not auto-renew unless explicitly stated</li>
                        <li>Payment is required in full at the time of purchase</li>
                        <li>We accept PayPal, credit/debit cards, and cryptocurrency</li>
                    </ul>
                </section>
                
                <section id="refunds">
                    <h2>5. Refund Policy</h2>
                    <p>We offer a 24-hour money-back guarantee for new subscribers. If you are not satisfied with our service within 24 hours of activation, you may request a full refund by contacting our support team.</p>
                    <p>Refund conditions:</p>
                    <ul>
                        <li>Refund requests must be made within 24 hours of activation</li>
                        <li>Refunds are only available for first-time subscribers</li>
                        <li>Renewal subscriptions are not eligible for refunds</li>
                        <li>Refunds will be processed to the original payment method</li>
                    </ul>
                </section>
                
                <section id="usage">
                    <h2>6. Acceptable Use</h2>
                    <p>You agree not to use our services for any unlawful purpose or in any way that could damage, disable, or impair our services. Prohibited activities include:</p>
                    <ul>
                        <li>Sharing your subscription credentials beyond allowed connections</li>
                        <li>Reselling or redistributing our services without authorization</li>
                        <li>Attempting to bypass any security measures</li>
                        <li>Recording or redistributing streamed content</li>
                        <li>Using VPNs or proxies to circumvent geographic restrictions</li>
                    </ul>
                </section>
                
                <section id="termination">
                    <h2>7. Termination</h2>
                    <p>We may terminate or suspend your account immediately, without prior notice or liability, for any reason, including if you breach these Terms of Service.</p>
                    <p>Upon termination, your right to use the service will cease immediately. We are not liable for any loss or damage resulting from account termination.</p>
                </section>
                
                <section id="liability">
                    <h2>8. Limitation of Liability</h2>
                    <p>In no event shall BestLiveIPTV, its directors, employees, or affiliates be liable for any indirect, incidental, special, consequential, or punitive damages resulting from your use or inability to use our services.</p>
                    <p>Our total liability shall not exceed the amount you paid for the service in the 12 months preceding the claim.</p>
                </section>
                
                <section id="changes">
                    <h2>9. Changes to Terms</h2>
                    <p>We reserve the right to modify these terms at any time. Changes will be effective immediately upon posting on our website. Your continued use of the service after any changes constitutes acceptance of the new terms.</p>
                </section>
                
                <section id="contact">
                    <h2>10. Contact Information</h2>
                    <p>If you have any questions about these Terms of Service, please contact us:</p>
                    <ul>
                        <li>Email: support@bestliveiptv.com</li>
                        <li>Contact Form: <a href="{{ route('contact') }}">Contact Page</a></li>
                    </ul>
                </section>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    .page-hero-small {
        padding: 160px 0 60px;
        background: linear-gradient(135deg, #0a0f1a 0%, #0d1525 100%);
        text-align: center;
        color: var(--white);
    }
    
    .page-hero-small .page-title {
        font-family: var(--font-display);
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    
    .page-hero-small .page-subtitle {
        color: rgba(255, 255, 255, 0.6);
    }
    
    .legal-section {
        padding: 4rem 0;
        background: var(--gray-50);
    }
    
    .legal-content {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 3rem;
        align-items: start;
    }
    
    .legal-nav {
        position: sticky;
        top: 120px;
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
    }
    
    .legal-nav h4 {
        font-family: var(--font-display);
        font-size: 1rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .legal-nav ul {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .legal-nav a {
        display: block;
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        color: var(--gray-600);
        border-radius: var(--radius-md);
        transition: var(--transition-base);
    }
    
    .legal-nav a:hover {
        background: var(--primary-50);
        color: var(--primary-600);
    }
    
    .legal-main {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-md);
    }
    
    .legal-main section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--gray-100);
    }
    
    .legal-main section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .legal-main h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }
    
    .legal-main p {
        color: var(--gray-600);
        line-height: 1.8;
        margin-bottom: 1rem;
    }
    
    .legal-main ul {
        margin: 1rem 0;
        padding-left: 1.5rem;
    }
    
    .legal-main li {
        color: var(--gray-600);
        margin-bottom: 0.5rem;
        list-style-type: disc;
    }
    
    .legal-main a {
        color: var(--primary-600);
    }
    
    .legal-main a:hover {
        text-decoration: underline;
    }
    
    @media (max-width: 1024px) {
        .legal-content {
            grid-template-columns: 1fr;
        }
        
        .legal-nav {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .page-hero-small {
            padding: 140px 0 40px;
        }
        
        .page-hero-small .page-title {
            font-size: 2rem;
        }
        
        .legal-main {
            padding: 1.5rem;
        }
    }
</style>
@endpush
@endsection
