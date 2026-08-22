@extends('layouts.app')

@section('title', 'Contact Us - BestLiveIPTV')

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
                    We're Here to <span class="text-gradient">Help You</span>
                </h1>
                
                <p class="page-hero-subtitle">
                    Have questions? Our dedicated support team is available 24/7 
                    to assist you with any inquiries about our IPTV service.
                </p>
                
                <div class="page-hero-features">
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-clock"></i>
                        <span>24/7 Support</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-lightning"></i>
                        <span>Fast Response</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-globe"></i>
                        <span>Multi-Language</span>
                    </div>
                </div>
            </div>
            
            <div class="page-hero-visual" data-aos="fade-left" data-aos-delay="200">
                <div class="page-hero-image">
                    <div class="page-hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1423666639041-f56000c27a9a?w=600&h=400&fit=crop" 
                             alt="Contact Us Support" 
                             class="page-hero-img"
                             loading="lazy">
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-1">
                        <div class="page-hero-floating-icon green">
                            <i class="ph-fill ph-check-circle"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">&lt; 1hr</span>
                            <span class="page-hero-floating-label">Response</span>
                        </div>
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-2">
                        <div class="page-hero-floating-icon blue">
                            <i class="ph-fill ph-star"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">4.9★</span>
                            <span class="page-hero-floating-label">Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info" data-aos="fade-right">
                <h2 class="info-title">Contact Information</h2>
                <p class="info-subtitle">Reach out to us through any of these channels</p>
                
                <div class="contact-cards">
                    <div class="contact-card">
                        <div class="card-icon">
                            <i class="ph-fill ph-envelope"></i>
                        </div>
                        <div class="card-content">
                            <h4>Email Us</h4>
                            <a href="mailto:info@bestliveiptv.com">info@bestliveiptv.com</a>
                            <a href="mailto:support@bestliveiptv.com">support@bestliveiptv.com</a>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="card-icon">
                            <i class="ph-fill ph-whatsapp-logo"></i>
                        </div>
                        <div class="card-content">
                            <h4>WhatsApp</h4>
                            <a href="#">+1 (555) 123-4567</a>
                            <span class="availability">Available 24/7</span>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="card-icon">
                            <i class="ph-fill ph-telegram-logo"></i>
                        </div>
                        <div class="card-content">
                            <h4>Telegram</h4>
                            <a href="#">@BestLiveIPTV</a>
                            <span class="availability">Instant Response</span>
                        </div>
                    </div>
                    
                    <div class="contact-card">
                        <div class="card-icon">
                            <i class="ph-fill ph-clock"></i>
                        </div>
                        <div class="card-content">
                            <h4>Support Hours</h4>
                            <span>24 Hours a Day</span>
                            <span>7 Days a Week</span>
                        </div>
                    </div>
                </div>
                
                <div class="social-section">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#" class="social-btn"><i class="ph-fill ph-facebook-logo"></i></a>
                        <a href="#" class="social-btn"><i class="ph-fill ph-twitter-logo"></i></a>
                        <a href="#" class="social-btn"><i class="ph-fill ph-instagram-logo"></i></a>
                        <a href="#" class="social-btn"><i class="ph-fill ph-youtube-logo"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Contact Form -->
            <div class="contact-form-wrapper" data-aos="fade-left">
                <div class="form-card">
                    <h2 class="form-title">Send us a Message</h2>
                    <p class="form-subtitle">Fill out the form below and we'll get back to you within 24 hours.</p>
                    
                    @if(session('success'))
                    <div class="alert alert-success">
                        <i class="ph-fill ph-check-circle"></i>
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="alert alert-error">
                        <i class="ph-fill ph-x-circle"></i>
                        <span>Please fix the errors below and try again.</span>
                    </div>
                    @endif
                    
                    <form action="{{ route('contact.store') }}" method="POST" class="contact-form" data-validate>
                        @csrf
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="name">Full Name <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="ph ph-user"></i>
                                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="John Doe">
                                </div>
                                @error('name')
                                <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="ph ph-envelope"></i>
                                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="john@example.com">
                                </div>
                                @error('email')
                                <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="phone">Phone Number</label>
                                <div class="input-wrapper">
                                    <i class="ph ph-phone"></i>
                                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+1 (555) 123-4567">
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="subject">Subject <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="ph ph-chat-circle"></i>
                                    <select id="subject" name="subject" required>
                                        <option value="">Select a subject</option>
                                        <option value="General Inquiry" {{ old('subject') == 'General Inquiry' ? 'selected' : '' }}>General Inquiry</option>
                                        <option value="Technical Support" {{ old('subject') == 'Technical Support' ? 'selected' : '' }}>Technical Support</option>
                                        <option value="Billing Question" {{ old('subject') == 'Billing Question' ? 'selected' : '' }}>Billing Question</option>
                                        <option value="Subscription Help" {{ old('subject') == 'Subscription Help' ? 'selected' : '' }}>Subscription Help</option>
                                        <option value="Refund Request" {{ old('subject') == 'Refund Request' ? 'selected' : '' }}>Refund Request</option>
                                        <option value="Other" {{ old('subject') == 'Other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>
                                @error('subject')
                                <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="message">Message <span class="required">*</span></label>
                            <div class="input-wrapper textarea-wrapper">
                                <i class="ph ph-note-pencil"></i>
                                <textarea id="message" name="message" rows="5" required placeholder="How can we help you?">{{ old('message') }}</textarea>
                            </div>
                            @error('message')
                            <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                            <i class="ph ph-paper-plane-tilt"></i>
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Quick Links -->
<section class="faq-quick-section">
    <div class="container">
        <div class="faq-quick-content" data-aos="fade-up">
            <div class="quick-info">
                <h2>Need Quick Answers?</h2>
                <p>Check out our frequently asked questions for instant answers to common queries.</p>
            </div>
            <a href="{{ route('faq') }}" class="btn btn-outline btn-lg">
                <i class="ph ph-question"></i>
                View FAQ
            </a>
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
    
    .contact-section {
        padding: 5rem 0;
        background: var(--gray-50);
    }
    
    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 4rem;
        align-items: start;
    }
    
    .contact-info {
        position: sticky;
        top: 150px;
    }
    
    .info-title {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .info-subtitle {
        color: var(--gray-600);
        margin-bottom: 2rem;
    }
    
    .contact-cards {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 2rem;
    }
    
    .contact-card {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.25rem;
        background: var(--white);
        border-radius: var(--radius-lg);
        border: 1px solid var(--gray-100);
        transition: var(--transition-base);
    }
    
    .contact-card:hover {
        border-color: var(--primary-200);
        box-shadow: var(--shadow-md);
    }
    
    .card-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        flex-shrink: 0;
    }
    
    .card-icon i {
        font-size: 1.5rem;
        color: var(--white);
    }
    
    .card-content h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .card-content a,
    .card-content span {
        display: block;
        font-size: 0.9375rem;
        color: var(--gray-600);
    }
    
    .card-content a:hover {
        color: var(--primary-500);
    }
    
    .availability {
        font-size: 0.8125rem !important;
        color: var(--success) !important;
        font-weight: 500;
    }
    
    .social-section h4 {
        font-weight: 600;
        color: var(--gray-900);
        margin-bottom: 1rem;
    }
    
    .social-links {
        display: flex;
        gap: 0.75rem;
    }
    
    .social-btn {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        color: var(--gray-600);
        font-size: 1.25rem;
        transition: var(--transition-base);
    }
    
    .social-btn:hover {
        background: var(--gradient-primary);
        border-color: transparent;
        color: var(--white);
        transform: translateY(-3px);
    }
    
    /* Form Styles */
    .form-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--gray-100);
    }
    
    .form-title {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .form-subtitle {
        color: var(--gray-600);
        margin-bottom: 2rem;
    }
    
    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 1.25rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
    }
    
    .alert i {
        font-size: 1.25rem;
    }
    
    .alert-success {
        background: #ECFDF5;
        color: #047857;
        border: 1px solid #A7F3D0;
    }
    
    .alert-error {
        background: #FEF2F2;
        color: #B91C1C;
        border: 1px solid #FECACA;
    }
    
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        font-weight: 600;
        color: var(--gray-700);
        margin-bottom: 0.5rem;
        font-size: 0.9375rem;
    }
    
    .required {
        color: var(--error);
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .input-wrapper i {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-400);
        font-size: 1.125rem;
        pointer-events: none;
    }
    
    .textarea-wrapper i {
        top: 1rem;
        transform: none;
    }
    
    .input-wrapper input,
    .input-wrapper select,
    .input-wrapper textarea {
        width: 100%;
        padding: 0.875rem 1rem 0.875rem 3rem;
        font-size: 0.9375rem;
        color: var(--gray-800);
        background: var(--gray-50);
        border: 2px solid var(--gray-200);
        border-radius: var(--radius-lg);
        transition: var(--transition-base);
        font-family: inherit;
    }
    
    .input-wrapper input:focus,
    .input-wrapper select:focus,
    .input-wrapper textarea:focus {
        outline: none;
        border-color: var(--primary-500);
        background: var(--white);
        box-shadow: 0 0 0 4px rgba(0, 102, 255, 0.1);
    }
    
    .input-wrapper input::placeholder,
    .input-wrapper textarea::placeholder {
        color: var(--gray-400);
    }
    
    .input-wrapper textarea {
        resize: vertical;
        min-height: 120px;
    }
    
    .input-wrapper.error input,
    .input-wrapper.error textarea {
        border-color: var(--error);
    }
    
    .field-error {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.8125rem;
        color: var(--error);
    }
    
    /* FAQ Quick Section */
    .faq-quick-section {
        padding: 3rem 0;
        background: var(--white);
    }
    
    .faq-quick-content {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 2rem;
        padding: 2rem;
        background: var(--primary-50);
        border-radius: var(--radius-xl);
        border: 1px solid var(--primary-100);
    }
    
    .quick-info h2 {
        font-family: var(--font-display);
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.25rem;
    }
    
    .quick-info p {
        color: var(--gray-600);
    }
    
    @media (max-width: 1024px) {
        .contact-grid {
            grid-template-columns: 1fr;
            gap: 3rem;
        }
        
        .contact-info {
            position: static;
        }
    }
    
    @media (max-width: 768px) {
        .page-hero {
            padding: 140px 0 60px;
        }
        
        .form-row {
            grid-template-columns: 1fr;
        }
        
        .form-card {
            padding: 1.5rem;
        }
        
        .faq-quick-content {
            flex-direction: column;
            text-align: center;
        }
    }
</style>
@endpush
@endsection
