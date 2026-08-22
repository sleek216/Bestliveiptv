@extends('layouts.app')

@section('title', 'Privacy Policy - BestLiveIPTV')

@section('content')
<!-- Page Hero -->
<section class="page-hero-small">
    <div class="container">
        <h1 class="page-title">Privacy Policy</h1>
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
                    <li><a href="#introduction">1. Introduction</a></li>
                    <li><a href="#collection">2. Information We Collect</a></li>
                    <li><a href="#use">3. How We Use Your Information</a></li>
                    <li><a href="#sharing">4. Information Sharing</a></li>
                    <li><a href="#security">5. Data Security</a></li>
                    <li><a href="#cookies">6. Cookies</a></li>
                    <li><a href="#rights">7. Your Rights</a></li>
                    <li><a href="#retention">8. Data Retention</a></li>
                    <li><a href="#children">9. Children's Privacy</a></li>
                    <li><a href="#contact">10. Contact Us</a></li>
                </ul>
            </div>
            
            <div class="legal-main">
                <section id="introduction">
                    <h2>1. Introduction</h2>
                    <p>BestLiveIPTV ("we," "our," or "us") is committed to protecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you use our IPTV streaming services.</p>
                    <p>By using our services, you consent to the data practices described in this policy. If you do not agree with the terms of this privacy policy, please do not access or use our services.</p>
                </section>
                
                <section id="collection">
                    <h2>2. Information We Collect</h2>
                    <p>We may collect the following types of information:</p>
                    
                    <h3>Personal Information</h3>
                    <ul>
                        <li>Name and email address</li>
                        <li>Billing information and payment details</li>
                        <li>Contact information (phone number, messaging app IDs)</li>
                        <li>Account credentials</li>
                    </ul>
                    
                    <h3>Technical Information</h3>
                    <ul>
                        <li>IP address and device identifiers</li>
                        <li>Browser type and version</li>
                        <li>Device type and operating system</li>
                        <li>Usage data and viewing preferences</li>
                    </ul>
                </section>
                
                <section id="use">
                    <h2>3. How We Use Your Information</h2>
                    <p>We use the collected information for various purposes:</p>
                    <ul>
                        <li>To provide and maintain our services</li>
                        <li>To process transactions and send related information</li>
                        <li>To send you service-related communications</li>
                        <li>To provide customer support</li>
                        <li>To improve and personalize your experience</li>
                        <li>To detect and prevent fraud or abuse</li>
                        <li>To comply with legal obligations</li>
                    </ul>
                </section>
                
                <section id="sharing">
                    <h2>4. Information Sharing</h2>
                    <p>We do not sell, trade, or rent your personal information to third parties. We may share your information only in the following circumstances:</p>
                    <ul>
                        <li><strong>Service Providers:</strong> With third-party vendors who assist in providing our services (payment processors, hosting providers)</li>
                        <li><strong>Legal Requirements:</strong> When required by law or to respond to legal process</li>
                        <li><strong>Protection:</strong> To protect our rights, privacy, safety, or property</li>
                        <li><strong>Business Transfers:</strong> In connection with a merger, acquisition, or sale of assets</li>
                    </ul>
                </section>
                
                <section id="security">
                    <h2>5. Data Security</h2>
                    <p>We implement appropriate technical and organizational security measures to protect your personal information, including:</p>
                    <ul>
                        <li>256-bit SSL encryption for data transmission</li>
                        <li>Secure password hashing</li>
                        <li>Regular security audits</li>
                        <li>Access controls and authentication</li>
                        <li>Secure data storage practices</li>
                    </ul>
                    <p>However, no method of transmission over the Internet is 100% secure, and we cannot guarantee absolute security.</p>
                </section>
                
                <section id="cookies">
                    <h2>6. Cookies</h2>
                    <p>We use cookies and similar tracking technologies to enhance your experience. Cookies are small data files stored on your device that help us:</p>
                    <ul>
                        <li>Remember your preferences and settings</li>
                        <li>Understand how you use our services</li>
                        <li>Improve our services based on usage patterns</li>
                        <li>Provide personalized content</li>
                    </ul>
                    <p>You can control cookies through your browser settings. However, disabling cookies may affect the functionality of our services.</p>
                </section>
                
                <section id="rights">
                    <h2>7. Your Rights</h2>
                    <p>Depending on your location, you may have the following rights regarding your personal information:</p>
                    <ul>
                        <li><strong>Access:</strong> Request access to your personal data</li>
                        <li><strong>Correction:</strong> Request correction of inaccurate data</li>
                        <li><strong>Deletion:</strong> Request deletion of your personal data</li>
                        <li><strong>Portability:</strong> Request transfer of your data</li>
                        <li><strong>Objection:</strong> Object to processing of your data</li>
                        <li><strong>Withdrawal:</strong> Withdraw consent at any time</li>
                    </ul>
                    <p>To exercise these rights, please contact us using the information provided below.</p>
                </section>
                
                <section id="retention">
                    <h2>8. Data Retention</h2>
                    <p>We retain your personal information only for as long as necessary to fulfill the purposes outlined in this privacy policy, unless a longer retention period is required by law.</p>
                    <p>When your account is terminated, we will delete or anonymize your personal information within a reasonable timeframe, unless retention is required for legal or business purposes.</p>
                </section>
                
                <section id="children">
                    <h2>9. Children's Privacy</h2>
                    <p>Our services are not intended for individuals under the age of 18. We do not knowingly collect personal information from children. If you are a parent or guardian and believe your child has provided us with personal information, please contact us immediately.</p>
                </section>
                
                <section id="contact">
                    <h2>10. Contact Us</h2>
                    <p>If you have questions or concerns about this Privacy Policy or our data practices, please contact us:</p>
                    <ul>
                        <li>Email: privacy@bestliveiptv.com</li>
                        <li>Support: support@bestliveiptv.com</li>
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
    
    .legal-main h3 {
        font-size: 1.125rem;
        font-weight: 600;
        color: var(--gray-800);
        margin: 1.5rem 0 0.75rem;
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
