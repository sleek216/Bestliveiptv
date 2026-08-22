<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, viewport-fit=cover">
    <meta name="theme-color" content="#0066FF">
    <meta name="description" content="Best Live IPTV - Premium IPTV Service with 20,000+ Channels, HD & 4K Quality, 99.9% Uptime. Get the best streaming experience worldwide.">
    <meta name="keywords" content="IPTV, streaming, live TV, 4K IPTV, HD channels, premium IPTV">
    <meta name="author" content="Best Live IPTV">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Best Live IPTV - Premium Streaming Service')</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset('images/favicon.svg') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Phosphor Icons -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Custom Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/unique-animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    
    <!-- Crisp Chat -->
    @php
        $crispId = \App\Models\Setting::get('crisp_website_id');
    @endphp
    @if($crispId)
    <script type="text/javascript">window.$crisp=[];window.CRISP_WEBSITE_ID="{{ $crispId }}";(function(){d=document;s=d.createElement("script");s.src="https://client.crisp.chat/l.js";s.async=1;d.getElementsByTagName("head")[0].appendChild(s);})();</script>
    @endif

    @stack('styles')
    <style>
        .lang-dropdown-menu {
            display: none;
            position: absolute;
            top: 120%;
            right: 0;
            background: #121620; /* Darker bg */
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 8px;
            min-width: 160px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            z-index: 1000;
            backdrop-filter: blur(10px);
        }
        .lang-dropdown-menu.show { display: block; animation: fadeIn 0.2s ease; }
        .lang-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            color: #ccc;
            text-decoration: none;
            border-radius: 8px;
            transition: all 0.2s;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .lang-item:hover { background: rgba(255,255,255,0.05); color: #fff; transform: translateX(5px); }
        .lang-item.active { background: #0066FF; color: white; }
        
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <script>
        document.addEventListener('click', function(e) {
            const wrapper = document.querySelector('.lang-dropdown-wrapper');
            const dropdown = document.getElementById('langDropdown');
            if (wrapper && !wrapper.contains(e.target) && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });
    </script>
</head>
<body class="antialiased">
    <!-- Announcement Bar -->
    <!-- Announcement Bar -->
    @php
        $announcementEnabled = \App\Models\Setting::get('announcement_enabled', '1');
        $announcementText = \App\Models\Setting::get('announcement_text', 'Get <strong>50% OFF</strong> on annual plans — Use code: <code>LIVE50</code>');
        $announcementLink = \App\Models\Setting::get('announcement_link', '/packages');
        $announcementLinkText = \App\Models\Setting::get('announcement_link_text', 'Shop Now');
    @endphp

    @if($announcementEnabled === '1' && !empty($announcementText))
    <div class="promo-bar" id="promoBar">
        <div class="promo-bar__inner">
            <div class="promo-bar__content">
                <span class="promo-bar__tag">Limited Offer</span>
                <p class="promo-bar__text">{!! $announcementText !!}</p>
                @if($announcementLink)
                <a href="{{ $announcementLink }}" class="promo-bar__link">
                    {{ $announcementLinkText }} <i class="ph-bold ph-arrow-right"></i>
                </a>
                @endif
            </div>
            <button class="promo-bar__close" id="closePromo" aria-label="Dismiss">
                <i class="ph ph-x"></i>
            </button>
        </div>
    </div>
    @endif


    <!-- Header -->
    <header class="site-header" id="siteHeader" style="{{ ($announcementEnabled !== '1' || empty($announcementText)) ? 'top: 0;' : '' }}">
        <div class="container">
            <nav class="site-nav">
                <!-- Brand -->
                <a href="{{ route('home') }}" class="brand">
                    <span class="brand__icon">
                        <svg viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="4" y="8" width="32" height="20" rx="2" fill="url(#brandGrad)"/>
                            <rect x="6" y="10" width="28" height="16" rx="1" fill="#fff"/>
                            <polygon points="17,14 17,22 25,18" fill="url(#brandGrad)"/>
                            <rect x="14" y="29" width="12" height="2" rx="1" fill="url(#brandGrad)"/>
                            <rect x="10" y="32" width="20" height="2" rx="1" fill="url(#brandGrad)" opacity="0.6"/>
                            <defs>
                                <linearGradient id="brandGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#0066FF"/>
                                    <stop offset="100%" stop-color="#00D4FF"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </span>
                    <span class="brand__text">
                        <span class="brand__name">Best<em>Live</em>IPTV</span>
                        <span class="brand__tagline">Premium Streaming</span>
                    </span>
                </a>

                <!-- Main Navigation -->
                <ul class="main-nav" id="mainNav">
                    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">{{ __('Home') }}</a></li>
                    <li><a href="{{ route('packages.index') }}" class="{{ request()->routeIs('packages.*') ? 'is-active' : '' }}">{{ __('Pricing') }}</a></li>
                    <li><a href="{{ route('channels') }}" class="{{ request()->routeIs('channels') ? 'is-active' : '' }}">{{ __('Channels') }}</a></li>
                    <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'is-active' : '' }}">{{ __('FAQ') }}</a></li>
                    <li><a href="{{ route('affiliate.info') }}" class="{{ request()->routeIs('affiliate.info') ? 'is-active' : '' }}">{{ __('Affiliate') }}</a></li>
                    <li><a href="{{ route('reseller.index') }}" class="{{ request()->routeIs('reseller.*') ? 'is-active' : '' }}">{{ __('Reseller') }}</a></li>
                    <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'is-active' : '' }}">{{ __('Blog') }}</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">{{ __('Contact') }}</a></li>
                </ul>

                <!-- Header Actions (Desktop Only) -->
                <div class="header-actions d-none d-lg-flex" style="gap: 8px;">
                    <!-- Language Dropdown -->
                    <div class="lang-dropdown-wrapper" style="position: relative; margin-right: 5px;">
                        <button class="btn btn--outline btn--sm d-flex align-items-center gap-1" style="padding: 4px 8px; font-size: 0.85rem;" onclick="document.getElementById('langDropdown').classList.toggle('show')">
                            <i class="ph ph-globe"></i>
                            <span class="d-none d-lg-inline">{{ strtoupper(app()->getLocale()) }}</span>
                            <i class="ph ph-caret-down"></i>
                        </button>
                        <div id="langDropdown" class="lang-dropdown-menu">
                            <a href="{{ route('lang.switch', 'en') }}" class="lang-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                                <span>🇺🇸</span> English
                            </a>
                            <a href="{{ route('lang.switch', 'es') }}" class="lang-item {{ app()->getLocale() == 'es' ? 'active' : '' }}">
                                <span>🇪🇸</span> Español
                            </a>
                            <a href="{{ route('lang.switch', 'fr') }}" class="lang-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}">
                                <span>🇫🇷</span> Français
                            </a>
                            <a href="{{ route('lang.switch', 'de') }}" class="lang-item {{ app()->getLocale() == 'de' ? 'active' : '' }}">
                                <span>🇩🇪</span> Deutsch
                            </a>
                            <a href="{{ route('lang.switch', 'pt') }}" class="lang-item {{ app()->getLocale() == 'pt' ? 'active' : '' }}">
                                <span>🇵🇹</span> Português
                            </a>
                            <a href="{{ route('lang.switch', 'it') }}" class="lang-item {{ app()->getLocale() == 'it' ? 'active' : '' }}">
                                <span>🇮🇹</span> Italiano
                            </a>
                            <a href="{{ route('lang.switch', 'ar') }}" class="lang-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}">
                                <span>🇸🇦</span> العربية
                            </a>
                            <a href="{{ route('lang.switch', 'nl') }}" class="lang-item {{ app()->getLocale() == 'nl' ? 'active' : '' }}">
                                <span>🇳🇱</span> Nederlands
                            </a>
                        </div>
                    </div>

                    @auth
                        <a href="{{ route('profile') }}" class="btn btn--outline btn--sm">
                            <i class="ph ph-user"></i> {{ Auth::user()->name }}
                        </a>
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="btn btn--primary btn--sm">
                                <i class="ph ph-gear"></i> {{ __('Admin Panel') }}
                            </a>
                        @else
                            <a href="{{ route('packages.index') }}" class="btn btn--primary btn--sm">
                                {{ __('Get Started') }}
                            </a>
                        @endif
                    @else
                        <a href="{{ route('login') }}" class="btn btn--outline btn--sm">
                            <i class="ph ph-sign-in"></i> {{ __('Login') }}
                        </a>
                        <a href="{{ route('register') }}" class="btn btn--primary btn--sm">
                            {{ __('Register') }}
                        </a>
                    @endauth
                </div>

                <!-- Mobile Language (Visible on Mobile/Tablet) -->
                <div class="mobile-lang-wrapper d-flex d-lg-none" style="position: relative; margin-right: 10px;">
                    <button class="btn btn--outline btn--sm d-flex align-items-center gap-2" style="padding: 6px 10px;" onclick="toggleMobileLang(event)">
                        <i class="ph ph-globe"></i>
                        <span>{{ strtoupper(app()->getLocale()) }}</span>
                    </button>
                    <div id="mobileLangDropdown" class="lang-dropdown-menu" style="top: 110%; right: -10px; min-width: 140px; max-height: 300px; overflow-y: auto;">
                        <a href="{{ route('lang.switch', 'en') }}" class="lang-item {{ app()->getLocale() == 'en' ? 'active' : '' }}">
                            <span>🇺🇸</span> EN
                        </a>
                        <a href="{{ route('lang.switch', 'es') }}" class="lang-item {{ app()->getLocale() == 'es' ? 'active' : '' }}">
                            <span>🇪🇸</span> ES
                        </a>
                        <a href="{{ route('lang.switch', 'fr') }}" class="lang-item {{ app()->getLocale() == 'fr' ? 'active' : '' }}">
                            <span>🇫🇷</span> FR
                        </a>
                        <a href="{{ route('lang.switch', 'de') }}" class="lang-item {{ app()->getLocale() == 'de' ? 'active' : '' }}">
                            <span>🇩🇪</span> DE
                        </a>
                        <a href="{{ route('lang.switch', 'pt') }}" class="lang-item {{ app()->getLocale() == 'pt' ? 'active' : '' }}">
                            <span>🇵🇹</span> PT
                        </a>
                        <a href="{{ route('lang.switch', 'it') }}" class="lang-item {{ app()->getLocale() == 'it' ? 'active' : '' }}">
                            <span>🇮🇹</span> IT
                        </a>
                        <a href="{{ route('lang.switch', 'ar') }}" class="lang-item {{ app()->getLocale() == 'ar' ? 'active' : '' }}">
                            <span>🇸🇦</span> AR
                        </a>
                        <a href="{{ route('lang.switch', 'nl') }}" class="lang-item {{ app()->getLocale() == 'nl' ? 'active' : '' }}">
                            <span>🇳🇱</span> NL
                        </a>
                    </div>
                </div>

                <!-- Mobile Toggle -->
                <button class="nav-toggle" id="navToggle" aria-label="Menu">
                    <span></span>
                </button>
            </nav>
        </div>
    </header>

    <!-- Mobile Nav -->
    <div class="mobile-nav" id="mobileNav">
        <div class="mobile-nav__inner">
            <ul class="mobile-nav__menu">
                <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">{{ __('Home') }}</a></li>
                <li><a href="{{ route('packages.index') }}" class="{{ request()->routeIs('packages.*') ? 'is-active' : '' }}">{{ __('Pricing') }}</a></li>
                <li><a href="{{ route('channels') }}" class="{{ request()->routeIs('channels') ? 'is-active' : '' }}">{{ __('Channels') }}</a></li>
                <li><a href="{{ route('faq') }}" class="{{ request()->routeIs('faq') ? 'is-active' : '' }}">{{ __('FAQ') }}</a></li>
                <li><a href="{{ route('affiliate.info') }}" class="{{ request()->routeIs('affiliate.info') ? 'is-active' : '' }}">{{ __('Affiliate') }}</a></li>
                <li><a href="{{ route('reseller.index') }}" class="{{ request()->routeIs('reseller.*') ? 'is-active' : '' }}">{{ __('Reseller') }}</a></li>
                <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'is-active' : '' }}">{{ __('Blog') }}</a></li>
                <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'is-active' : '' }}">{{ __('Contact') }}</a></li>
            </ul>
            <div class="mobile-nav__footer">
                @auth
                    <a href="{{ route('profile') }}" class="btn btn--outline btn--block">
                        <i class="ph ph-user"></i> {{ __('My Profile') }}
                    </a>
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="btn btn--primary btn--block">{{ __('Admin Panel') }}</a>
                    @else
                        <form action="{{ route('logout') }}" method="POST" style="width: 100%;">
                            @csrf
                            <button type="submit" class="btn btn--primary btn--block">{{ __('Logout') }}</button>
                        </form>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="btn btn--outline btn--block">{{ __('Login') }}</a>
                    <a href="{{ route('register') }}" class="btn btn--primary btn--block">{{ __('Register') }}</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Main -->
    <main class="main" id="main">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-top">
            <div class="container">
                <div class="footer-grid">
                    <!-- Company Info -->
                    <div class="footer-col footer-brand">
                        <a href="{{ route('home') }}" class="footer-logo">
                            <div class="logo-icon">
                                <svg viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <defs>
                                        <linearGradient id="footerLogoGradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                            <stop offset="0%" style="stop-color:#0066FF"/>
                                            <stop offset="50%" style="stop-color:#00D4FF"/>
                                            <stop offset="100%" style="stop-color:#0066FF"/>
                                        </linearGradient>
                                    </defs>
                                    <rect x="4" y="8" width="40" height="28" rx="4" fill="url(#footerLogoGradient)"/>
                                    <rect x="8" y="12" width="32" height="20" rx="2" fill="white"/>
                                    <polygon points="18,16 18,28 30,22" fill="url(#footerLogoGradient)"/>
                                    <rect x="16" y="38" width="16" height="3" rx="1.5" fill="url(#footerLogoGradient)"/>
                                    <rect x="12" y="42" width="24" height="2" rx="1" fill="url(#footerLogoGradient)" opacity="0.6"/>
                                </svg>
                            </div>
                            <span class="logo-name">Best<span class="logo-highlight">Live</span>IPTV</span>
                        </a>
                        <p class="footer-desc">
                            Experience the future of television with our premium IPTV service. 
                            20,000+ channels, HD & 4K quality, and 24/7 support.
                        </p>
                        <div class="footer-social">
                            <a href="#" class="social-link" aria-label="Facebook"><i class="ph-fill ph-facebook-logo"></i></a>
                            <a href="#" class="social-link" aria-label="Twitter"><i class="ph-fill ph-twitter-logo"></i></a>
                            <a href="#" class="social-link" aria-label="Instagram"><i class="ph-fill ph-instagram-logo"></i></a>
                            <a href="#" class="social-link" aria-label="Telegram"><i class="ph-fill ph-telegram-logo"></i></a>
                            <a href="#" class="social-link" aria-label="WhatsApp"><i class="ph-fill ph-whatsapp-logo"></i></a>
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div class="footer-col">
                        <h4 class="footer-title">{{ __('Quick Links') }}</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('home') }}"><i class="ph ph-caret-right"></i> {{ __('Home') }}</a></li>
                            <li><a href="{{ route('packages.index') }}"><i class="ph ph-caret-right"></i> {{ __('Pricing Plans') }}</a></li>
                            <li><a href="{{ route('channels') }}"><i class="ph ph-caret-right"></i> {{ __('Channel List') }}</a></li>
                            <li><a href="{{ route('reseller.index') }}"><i class="ph ph-caret-right"></i> {{ __('Reseller Program') }}</a></li>
                            <li><a href="{{ route('blog.index') }}"><i class="ph ph-caret-right"></i> {{ __('Blog & News') }}</a></li>
                            <li><a href="{{ route('faq') }}"><i class="ph ph-caret-right"></i> {{ __('FAQ') }}</a></li>
                            <li><a href="{{ route('contact') }}"><i class="ph ph-caret-right"></i> {{ __('Contact Us') }}</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div class="footer-col">
                        <h4 class="footer-title">{{ __('Support') }}</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('how-it-works') }}"><i class="ph ph-caret-right"></i> {{ __('How It Works') }}</a></li>
                            <li><a href="{{ route('faq') }}"><i class="ph ph-caret-right"></i> {{ __('Help Center') }}</a></li>
                            <li><a href="{{ route('contact') }}"><i class="ph ph-caret-right"></i> {{ __('Live Support') }}</a></li>
                            <li><a href="{{ route('terms') }}"><i class="ph ph-caret-right"></i> {{ __('Terms of Service') }}</a></li>
                            <li><a href="{{ route('privacy') }}"><i class="ph ph-caret-right"></i> {{ __('Privacy Policy') }}</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div class="footer-col">
                        <h4 class="footer-title">{{ __('Contact Us') }}</h4>
                        <ul class="footer-contact">
                            <li>
                                <i class="ph-fill ph-envelope"></i>
                                <a href="mailto:info@bestliveiptv.com">info@bestliveiptv.com</a>
                            </li>
                            <li>
                                <i class="ph-fill ph-whatsapp-logo"></i>
                                <a href="#">+1 (555) 123-4567</a>
                            </li>
                            <li>
                                <i class="ph-fill ph-telegram-logo"></i>
                                <a href="#">@BestLiveIPTV</a>
                            </li>
                            <li>
                                <i class="ph-fill ph-clock"></i>
                                <span>{{ __('24/7 Customer Support') }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Methods -->
        <div class="footer-payment">
            <div class="container">
                <div class="payment-content">
                    <span class="payment-label">{{ __('Secure Payment Methods') }}:</span>
                    <div class="payment-icons">
                        <div class="payment-icon" title="PayPal">
                            <i class="ph-fill ph-paypal-logo"></i>
                        </div>
                        <div class="payment-icon" title="Credit Card">
                            <i class="ph-fill ph-credit-card"></i>
                        </div>
                        <div class="payment-icon" title="Cryptocurrency">
                            <i class="ph-fill ph-currency-btc"></i>
                        </div>
                        <div class="payment-icon" title="Stripe">
                            <i class="ph-fill ph-stripe-logo"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="footer-bottom">
            <div class="container">
                <div class="footer-bottom-content">
                    <p class="copyright">
                        &copy; {{ date('Y') }} BestLiveIPTV. {{ __('All rights reserved') }}.
                    </p>
                    <ul class="footer-bottom-links">
                        <li><a href="{{ route('terms') }}">{{ __('Terms') }}</a></li>
                        <li><a href="{{ route('privacy') }}">{{ __('Privacy') }}</a></li>
                        <li><a href="{{ route('refund') }}">{{ __('Refund Policy') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- WhatsApp Chat Button -->
    @php
        $whatsappNumber = \App\Models\Setting::get('whatsapp_number');
    @endphp
    
    @if($whatsappNumber)
    <a href="https://wa.me/{{ $whatsappNumber }}" class="whatsapp-float" target="_blank" rel="noopener noreferrer" aria-label="Chat on WhatsApp">
        <i class="ph-fill ph-whatsapp-logo"></i>
    </a>

    <style>
        .whatsapp-float {
            position: fixed;
            bottom: 95px; /* Stacked VERTICALLY above Crisp (20px + 60px + 15px gap) */
            right: 24px; /* Aligned with Crisp Horizontal */
            width: 60px;
            height: 60px;
            background: linear-gradient(45deg, #25D366, #128C7E);
            color: #FFF;
            border-radius: 50%;
            text-align: center;
            font-size: 32px;
            box-shadow: 0 4px 12px rgba(37, 211, 102, 0.3);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            border: 2px solid rgba(255, 255, 255, 0.1);
        }

        .whatsapp-float:hover {
            transform: scale(1.1) translateY(-5px);
            color: #FFF;
            box-shadow: 0 8px 24px rgba(37, 211, 102, 0.5);
        }

        .whatsapp-float i {
            display: flex;
        }
        
        @media (max-width: 768px) {
            .whatsapp-float {
                bottom: 85px; /* Stacked on Mobile too */
                right: 20px;
                width: 50px;
                height: 50px;
                font-size: 26px;
                z-index: 9999;
            }
        }
    </style>
    @endif



    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/translations.js') }}"></script>
    
    <script>
    (function() {
        'use strict';
        
        // DOM Ready
        document.addEventListener('DOMContentLoaded', init);
        
        function init() {
            initPromoBar();
            initHeader();
            initMobileNav();
            initAOS();
        }
        
        // Promo Bar
        function initPromoBar() {
            const promo = document.getElementById('promoBar');
            const closeBtn = document.getElementById('closePromo');
            
            if (!promo || !closeBtn) return;
            
            if (sessionStorage.getItem('promoClosed')) {
                promo.classList.add('is-hidden');
                document.documentElement.style.setProperty('--promo-height', '0px');
            }
            
            closeBtn.addEventListener('click', function() {
                promo.classList.add('is-hidden');
                document.documentElement.style.setProperty('--promo-height', '0px');
                sessionStorage.setItem('promoClosed', '1');
            });
        }
        
        // Header
        function initHeader() {
            const header = document.getElementById('siteHeader');
            if (!header) return;
            
            let ticking = false;
            
            function onScroll() {
                if (!ticking) {
                    window.requestAnimationFrame(function() {
                        header.classList.toggle('is-scrolled', window.scrollY > 60);
                        ticking = false;
                    });
                    ticking = true;
                }
            }
            
            window.addEventListener('scroll', onScroll, { passive: true });
            onScroll();
        }
        
        // Mobile Navigation
        function initMobileNav() {
            const toggle = document.getElementById('navToggle');
            const nav = document.getElementById('mobileNav');
            
            if (!toggle || !nav) return;
            
            toggle.addEventListener('click', function() {
                const isOpen = toggle.classList.toggle('is-active');
                nav.classList.toggle('is-open', isOpen);
                document.body.classList.toggle('nav-open', isOpen);
            });
            
            // Close on link click
            nav.querySelectorAll('a').forEach(function(link) {
                link.addEventListener('click', function() {
                    toggle.classList.remove('is-active');
                    nav.classList.remove('is-open');
                    document.body.classList.remove('nav-open');
                });
            });
        }
        
        // AOS
        function initAOS() {
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 600,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 50
                });
            }
        }
    })();
    </script>
    
    <!-- Sales Notification -->
    <div id="sales-notification" class="sales-notification">
        <div class="sales-notification-icon">
            <i class="ph-fill ph-check-circle"></i>
        </div>
        <div class="sales-notification-content">
            <p class="sales-text">
                <span class="sales-name font-bold">John</span> from <span class="sales-country font-bold">UK</span>
                purchased a <span class="sales-plan">12 Months Plan</span>
            </p>
            <small class="sales-time text-gray-500">2 mins ago</small>
        </div>
        <button class="sales-close"><i class="ph ph-x"></i></button>
    </div>

    <style>
        .sales-notification {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 12px;
            z-index: 9999;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55);
            max-width: 350px;
            border-left: 4px solid var(--primary-500);
        }
        .sales-notification.active {
            transform: translateY(0);
            opacity: 1;
        }
        .sales-notification-icon {
            color: var(--success-500);
            font-size: 24px;
            flex-shrink: 0;
        }
        .sales-text { margin: 0; font-size: 14px; color: var(--gray-800); line-height: 1.4; }
        .sales-time { font-size: 12px; }
        .sales-close {
            background: none; border: none; cursor: pointer; color: var(--gray-400); margin-left: auto; flex-shrink: 0;
        }
        
        /* Mobile responsive for sales notification */
        @media (max-width: 480px) {
            .sales-notification {
                left: 10px;
                right: 10px;
                bottom: 10px;
                max-width: calc(100% - 20px);
                padding: 12px;
                gap: 10px;
            }
            .sales-notification-icon {
                font-size: 20px;
            }
            .sales-text {
                font-size: 12px;
            }
            .sales-time {
                font-size: 10px;
            }
        }
    </style>
    <style>
        .main-nav li a { padding: 0.5rem 0.6rem !important; font-size: 0.9rem; }
        @media (max-width: 1200px) { .main-nav li a { padding: 0.4rem 0.4rem !important; font-size: 0.85rem; } }
        .site-header .container { max-width: 98%; }
        
        /* Strict Visibility Control for Header Buttons */
        @media (min-width: 992px) {
            .mobile-lang-wrapper { display: none !important; }
            .header-actions { display: flex !important; }
        }
        @media (max-width: 991px) {
            .header-actions { display: none !important; }
            .mobile-lang-wrapper { display: flex !important; }
        }
    </style>
    
    <script>
        function toggleMobileLang(e) {
            e.stopPropagation();
            document.getElementById('mobileLangDropdown').classList.toggle('show');
        }
        
        /* Channels Modal Scripts Removed */
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const names = ['John', 'Sarah', 'Michael', 'Emma', 'David', 'James', 'Robert', 'Maria', 'Mohammed', 'Ali'];
            const countries = ['UK', 'USA', 'Canada', 'Australia', 'Germany', 'France', 'UAE', 'Saudi Arabia', 'Pakistan'];
            const plans = ['1 Month Plan', '3 Months Plan', '6 Months Plan', '12 Months Plan'];
            
            const notification = document.getElementById('sales-notification');
            const nameEl = notification.querySelector('.sales-name');
            const countryEl = notification.querySelector('.sales-country');
            const planEl = notification.querySelector('.sales-plan');
            const timeEl = notification.querySelector('.sales-time');
            const closeBtn = notification.querySelector('.sales-close');

            function showNotification() {
                const name = names[Math.floor(Math.random() * names.length)];
                const country = countries[Math.floor(Math.random() * countries.length)];
                const plan = plans[Math.floor(Math.random() * plans.length)];
                const time = Math.floor(Math.random() * 59) + 1 + ' mins ago';

                nameEl.textContent = name;
                countryEl.textContent = country;
                planEl.textContent = plan;
                timeEl.textContent = time;

                notification.classList.add('active');

                setTimeout(() => {
                    notification.classList.remove('active');
                }, 5000);
            }

            // Loop
            setTimeout(() => {
                showNotification();
                setInterval(showNotification, 15000); // Every 15 seconds
            }, 3000);

            closeBtn.addEventListener('click', () => {
                notification.classList.remove('active');
            });
        });
    </script>
    
    <!-- Channels Modal Removed -->
    
    @stack('scripts')
</body>
</html>
