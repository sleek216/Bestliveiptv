@extends('layouts.app')

@section('title', 'BestLiveIPTV - #1 Premium IPTV Service | 20,000+ Channels')

@section('content')
<!-- Hero Section -->
<section class="hero" id="heroSection">
    <div class="hero-bg" id="heroBg">
        <div class="hero-gradient"></div>
        <div class="hero-pattern"></div>
        <div class="hero-glow hero-glow-1"></div>
        <div class="hero-glow hero-glow-2"></div>
        
        <!-- Animated Channel Wall Background -->
        <div class="hero-channel-wall">
            @for($r = 0; $r < 4; $r++)
            <div class="channel-wall-row">
                @for($i = 0; $i < 2; $i++)
                    <div class="wall-item netflix">NETFLIX</div>
                    <div class="wall-item amazon">AMAZON</div>
                    <div class="wall-item hbo">HBO MAX</div>
                    <div class="wall-item disney">DISNEY+</div>
                    <div class="wall-item espn">ESPN</div>
                    <div class="wall-item sky">SKY SPORT</div>
                    <div class="wall-item nfl">NFL</div>
                    <div class="wall-item">CNN</div>
                    <div class="wall-item">BBC</div>
                @endfor
            </div>
            @endfor
        </div>
    </div>
    
    <!-- Full-Screen Playing Overlay (Hidden by default) -->
    <div class="hero-playing-overlay" id="heroPlayingOverlay">
        <button class="back-to-home" id="backToHome">
            <i class="ph ph-arrow-left"></i>
            <span>Back</span>
        </button>
        
        <div class="playing-fullscreen">
            <div class="playing-fullscreen-header">
                <div class="channel-logo-huge">
                    <span id="fullscreenChannelName">NETFLIX</span>
                </div>
                <div class="live-indicator-large">
                    <div class="live-dot-large"></div>
                    <span>LIVE</span>
                </div>
            </div>
            
            <div class="playing-fullscreen-content">
                <div class="video-player-large">
                    <div class="play-overlay-large">
                        <div class="play-icon-huge">
                            <i class="ph-fill ph-play"></i>
                        </div>
                    </div>
                    <div class="video-gradient-large"></div>
                </div>
                
                <div class="playing-info-large">
                    <h2>Now Playing</h2>
                    <p>Premium Content in 4K Ultra HD</p>
                    <div class="quality-indicators-large">
                        <span class="quality-tag-large">4K</span>
                        <span class="quality-tag-large">HDR</span>
                        <span class="quality-tag-large">Dolby 5.1</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="hero-content" id="heroContent">
            <div class="hero-text" data-aos="fade-right" data-aos-duration="1000">
                <h1 class="hero-title">
                    Experience The 
                    <span class="text-gradient">Future</span> of
                    <span class="text-gradient">Television</span>
                </h1>
                
                <p class="hero-subtitle">
                    {{ __('Stream 20,000+ premium channels...') }}
                </p>
                
                <div class="hero-features">
                    <div class="hero-feature">
                        <i class="ph-fill ph-television"></i>
                        <span>20,000+ Channels</span>
                    </div>
                    <div class="hero-feature">
                        <i class="ph-fill ph-film-strip"></i>
                        <span>100,000 VOD</span>
                    </div>
                    <div class="hero-feature">
                        <i class="ph-fill ph-globe"></i>
                        <span>150+ Countries</span>
                    </div>
                </div>

                <!-- Premium Content Logos -->
                <div class="hero-premium-logos" style="margin: 1.5rem 0;">
                    <p style="color: rgba(255,255,255,0.5); text-transform: uppercase; font-size: 0.7rem; letter-spacing: 2px; font-weight: 600; margin-bottom: 1rem;">{{ __('Premium Sports & Entertainment') }}</p>
                    <div style="display: flex; align-items: center; gap: 20px; flex-wrap: wrap;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/d/de/HBO_logo.svg" alt="HBO" style="height: 30px; width: auto; filter: brightness(0) invert(1); opacity: 0.9;">
                        <img src="{{ asset('images/nfl-logo.png') }}" alt="NFL" style="height: 45px; width: auto; opacity: 0.95;">
                        <img src="{{ asset('images/espn-logo.png') }}" alt="ESPN" style="height: 28px; width: auto; opacity: 0.95;">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/0/0c/Netflix_2014_logo.svg" alt="Netflix" style="height: 22px; width: auto; opacity: 0.9;">
                    </div>
                </div>

                <div class="hero-cta">
                    @if($freeTrialPackage)
                    <a href="{{ route('checkout.show', $freeTrialPackage->slug) }}" class="btn btn-primary btn-lg">
                        <i class="ph ph-play-circle"></i>
                        {{ __('Start Free Trial') }}
                    </a>
                    @else
                    <a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg">
                        <i class="ph ph-play-circle"></i>
                        {{ __('Start Free Trial') }}
                    </a>
                    @endif
                    <a href="{{ route('packages.index') }}" class="btn btn-glass btn-lg">
                        <i class="ph ph-currency-dollar"></i>
                        {{ __('View Pricing') }}
                    </a>
                </div>
                
                <div class="hero-trust">
                    <div class="trust-badges">
                        <div class="trust-badge">
                            <i class="ph-fill ph-shield-check"></i>
                            <span>SSL Secured</span>
                        </div>
                        <div class="trust-badge">
                            <i class="ph-fill ph-lock"></i>
                            <span>100% Private</span>
                        </div>
                        <div class="trust-badge">
                            <i class="ph-fill ph-arrow-counter-clockwise"></i>
                            <span>Money Back</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="hero-visual" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="200">
                <div class="hero-device" id="heroDevice">
                    <div class="device-frame">
                        <div class="device-screen">
                            <div class="screen-content" id="channelGridView">
                                <div class="channel-grid">
                                    <div class="channel-card interactive-channel" data-channel="netflix" data-color="#E50914"><span>NETFLIX</span></div>
                                    <div class="channel-card interactive-channel" data-channel="amazon" data-color="#00A8E1"><span>AMAZON</span></div>
                                    <div class="channel-card interactive-channel" data-channel="hbomax" data-color="#7B4FFF"><span>HBO MAX</span></div>
                                    <div class="channel-card interactive-channel" data-channel="disney" data-color="#113CCF"><span>DISNEY+</span></div>
                                    <div class="channel-card interactive-channel" data-channel="espn" data-color="#FF0033"><span>ESPN</span></div>
                                    <div class="channel-card interactive-channel" data-channel="cnn" data-color="#CC0000"><span>CNN</span></div>
                                    <div class="channel-card interactive-channel" data-channel="bbc" data-color="#000000"><span>BBC</span></div>
                                    <div class="channel-card interactive-channel" data-channel="sky" data-color="#0072C6"><span>SKY</span></div>
                                    <div class="channel-card interactive-channel" data-channel="nfl" data-color="#013369"><span>NFL</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="device-shadow"></div>
                </div>
                
                <!-- Floating Elements -->
                <div class="floating-badge floating-1">
                    <i class="ph-fill ph-play"></i>
                    <span>4K Ultra HD</span>
                </div>
                <div class="floating-badge floating-2">
                    <i class="ph-fill ph-broadcast"></i>
                    <span>Live Streaming</span>
                </div>
                <div class="floating-badge floating-3">
                    <i class="ph-fill ph-device-mobile"></i>
                    <span>Multi Device</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <div class="scroll-mouse">
            <div class="scroll-wheel"></div>
        </div>
        <span>Scroll to explore</span>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon">
                    <i class="ph-fill ph-chart-line-up"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number" data-count="99.9">99.9%</span>
                    <span class="stat-label">Uptime Guarantee</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="ph-fill ph-globe-hemisphere-west"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">150+</span>
                    <span class="stat-label">Global Servers</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="ph-fill ph-calendar-check"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">10+</span>
                    <span class="stat-label">Years in Business</span>
                </div>
            </div>
            
            <div class="stat-card" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="ph-fill ph-headset"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Customer Support</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="features-section" id="features">
    <div class="container">
        <div class="section-header" data-aos="fade-up"> 
            <h2 class="section-title">Premium Features for <span class="text-gradient">Premium Experience</span></h2>
            <p class="section-subtitle">
                Discover why thousands of customers trust us for their entertainment needs
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card" data-aos="fade-up" data-aos-delay="0">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-monitor-play"></i>
                </div>
                <h3 class="feature-title">20,000+ Live Channels</h3>
                <p class="feature-desc">Access thousands of live TV channels from around the world including sports, movies, news, and entertainment.</p>
                <div class="feature-tags">
                    <span>Sports</span>
                    <span>Movies</span>
                    <span>News</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-film-reel"></i>
                </div>
                <h3 class="feature-title">50,000+ VOD Library</h3>
                <p class="feature-desc">Enjoy our massive collection of movies and TV series on demand. New content added daily.</p>
                <div class="feature-tags">
                    <span>Movies</span>
                    <span>Series</span>
                    <span>Documentaries</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-high-definition"></i>
                </div>
                <h3 class="feature-title">HD & 4K Quality</h3>
                <p class="feature-desc">Experience crystal clear picture quality with our HD, Full HD, and 4K streaming options.</p>
                <div class="feature-tags">
                    <span>HD</span>
                    <span>Full HD</span>
                    <span>4K Ultra</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-devices"></i>
                </div>
                <h3 class="feature-title">Multi-Device Support</h3>
                <p class="feature-desc">Watch on any device - Smart TV, Android, iOS, Fire Stick, MAG Box, and more.</p>
                <div class="feature-tags">
                    <span>Smart TV</span>
                    <span>Mobile</span>
                    <span>Fire Stick</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="400">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-list-bullets"></i>
                </div>
                <h3 class="feature-title">TV Guide (EPG)</h3>
                <p class="feature-desc">Never miss your favorite shows with our electronic program guide. Plan your viewing ahead.</p>
                <div class="feature-tags">
                    <span>Schedule</span>
                    <span>Reminders</span>
                    <span>Listings</span>
                </div>
            </div>
            
            <div class="feature-card" data-aos="fade-up" data-aos-delay="500">
                <div class="feature-icon">
                    <div class="icon-glow"></div>
                    <i class="ph-fill ph-shield-checkered"></i>
                </div>
                <h3 class="feature-title">Anti-Freeze Technology</h3>
                <p class="feature-desc">Our advanced anti-freeze technology ensures smooth, buffer-free streaming experience.</p>
                <div class="feature-tags">
                    <span>No Buffer</span>
                    <span>Smooth</span>
                    <span>Stable</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Compatible Devices Section -->
<section class="devices-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Works on <span class="text-gradient">All Your Devices</span></h2>
            <p class="section-subtitle">
                Stream your favorite content on any device, anywhere, anytime
            </p>
        </div>
        
        <div class="devices-showcase" data-aos="fade-up" data-aos-delay="200">
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-television"></i>
                </div>
                <span class="device-name">Smart TV</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-android-logo"></i>
                </div>
                <span class="device-name">Android</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-apple-logo"></i>
                </div>
                <span class="device-name">iOS/iPhone</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-desktop"></i>
                </div>
                <span class="device-name">Windows PC</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-laptop"></i>
                </div>
                <span class="device-name">Mac</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-fire"></i>
                </div>
                <span class="device-name">Fire Stick</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-hard-drives"></i>
                </div>
                <span class="device-name">MAG Box</span>
            </div>
            <div class="device-item">
                <div class="device-icon">
                    <i class="ph-fill ph-game-controller"></i>
                </div>
                <span class="device-name">Xbox</span>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section class="pricing-section" id="pricing">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Choose Your <span class="text-gradient">Perfect Plan</span></h2>
            <p class="section-subtitle">
                Flexible pricing options to suit every need. All plans include all features.
            </p>
        </div>
        
        <!-- Plan Duration Tabs -->
        <div class="pricing-tabs" data-aos="fade-up" data-aos-delay="100">
            <button class="tab-btn active" data-tab="1_month">1 Month</button>
            <button class="tab-btn" data-tab="3_months">3 Months</button>
            <button class="tab-btn" data-tab="6_months">6 Months</button>
            <button class="tab-btn popular" data-tab="12_months">
                12 Months
                <span class="tab-badge">Best Value</span>
            </button>
            <button class="tab-btn" data-tab="lifetime">
                <i class="ph ph-infinity"></i>
                Lifetime
            </button>
        </div>
        
        <div class="pricing-grid" data-aos="fade-up" data-aos-delay="200">
            @foreach($packagesByDuration as $duration => $packages)
                @foreach($packages as $package)
                <div class="pricing-card {{ $package->is_popular ? 'popular' : '' }}" data-duration="{{ $duration }}" style="{{ $duration !== '1_month' ? 'display: none;' : '' }}">
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
                        Get Started
                    </a>
                </div>
                @endforeach
            @endforeach
            
            @if($packagesByDuration['1_month']->isEmpty())
            <!-- Default Pricing Cards -->
            <div class="pricing-card" data-duration="1_month">
                <div class="pricing-header">
                    <h3 class="plan-name">1 Device</h3>
                    <p class="plan-devices">Single Connection</p>
                </div>
                
                <div class="pricing-price">
                    <span class="original-price">$30</span>
                    <span class="current-price">
                        <span class="currency">$</span>
                        <span class="amount">15</span>
                    </span>
                    <span class="period">1 Month</span>
                </div>
                
                <ul class="pricing-features">
                    <li><i class="ph-fill ph-check-circle"></i> 20,000+ Channels & VOD</li>
                    <li><i class="ph-fill ph-check-circle"></i> HD & 4K Image Quality</li>
                    <li><i class="ph-fill ph-check-circle"></i> TV Guide (EPG)</li>
                    <li><i class="ph-fill ph-check-circle"></i> Anti-Freeze Technology</li>
                    <li><i class="ph-fill ph-check-circle"></i> Instant Delivery</li>
                    <li><i class="ph-fill ph-check-circle"></i> 24/7 Customer Support</li>
                </ul>
                
                <a href="{{ route('packages.index') }}" class="btn btn-outline btn-block">
                    <i class="ph ph-shopping-cart"></i>
                    Get Started
                </a>
            </div>
            
            <div class="pricing-card popular" data-duration="1_month">
                <div class="popular-badge">
                    <i class="ph-fill ph-crown"></i> Most Popular
                </div>
                <div class="discount-badge">
                    <span>50% OFF</span>
                </div>
                
                <div class="pricing-header">
                    <h3 class="plan-name">2 Devices</h3>
                    <p class="plan-devices">Family Plan</p>
                </div>
                
                <div class="pricing-price">
                    <span class="original-price">$50</span>
                    <span class="current-price">
                        <span class="currency">$</span>
                        <span class="amount">25</span>
                    </span>
                    <span class="period">1 Month</span>
                </div>
                
                <ul class="pricing-features">
                    <li><i class="ph-fill ph-check-circle"></i> 20,000+ Channels & VOD</li>
                    <li><i class="ph-fill ph-check-circle"></i> HD & 4K Image Quality</li>
                    <li><i class="ph-fill ph-check-circle"></i> TV Guide (EPG)</li>
                    <li><i class="ph-fill ph-check-circle"></i> Anti-Freeze Technology</li>
                    <li><i class="ph-fill ph-check-circle"></i> Instant Delivery</li>
                    <li><i class="ph-fill ph-check-circle"></i> 24/7 Customer Support</li>
                </ul>
                
                <a href="{{ route('packages.index') }}" class="btn btn-primary btn-block">
                    <i class="ph ph-shopping-cart"></i>
                    Get Started
                </a>
            </div>
            
            <div class="pricing-card" data-duration="1_month">
                <div class="pricing-header">
                    <h3 class="plan-name">3 Devices</h3>
                    <p class="plan-devices">Premium Plan</p>
                </div>
                
                <div class="pricing-price">
                    <span class="original-price">$70</span>
                    <span class="current-price">
                        <span class="currency">$</span>
                        <span class="amount">35</span>
                    </span>
                    <span class="period">1 Month</span>
                </div>
                
                <ul class="pricing-features">
                    <li><i class="ph-fill ph-check-circle"></i> 20,000+ Channels & VOD</li>
                    <li><i class="ph-fill ph-check-circle"></i> HD & 4K Image Quality</li>
                    <li><i class="ph-fill ph-check-circle"></i> TV Guide (EPG)</li>
                    <li><i class="ph-fill ph-check-circle"></i> Anti-Freeze Technology</li>
                    <li><i class="ph-fill ph-check-circle"></i> Instant Delivery</li>
                    <li><i class="ph-fill ph-check-circle"></i> 24/7 Customer Support</li>
                </ul>
                
                <a href="{{ route('packages.index') }}" class="btn btn-outline btn-block">
                    <i class="ph ph-shopping-cart"></i>
                    Get Started
                </a>
            </div>
            @endif
        </div>
        
        <div class="pricing-footer" data-aos="fade-up">
            <a href="{{ route('packages.index') }}" class="btn btn-glass btn-lg">
                <i class="ph ph-squares-four"></i>
                View All Plans
            </a>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Get Started in <span class="text-gradient">3 Easy Steps</span></h2>
            <p class="section-subtitle">
                Start streaming your favorite content in just minutes
            </p>
        </div>
        
        <div class="steps-grid">
            <div class="step-card" data-aos="fade-up" data-aos-delay="0">
                <div class="step-number">
                    <span>01</span>
                </div>
                <div class="step-icon">
                    <i class="ph-fill ph-cursor-click"></i>
                </div>
                <h3 class="step-title">Choose Your Plan</h3>
                <p class="step-desc">Select the subscription plan that best fits your needs. We offer flexible options for everyone.</p>
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
                    <i class="ph-fill ph-credit-card"></i>
                </div>
                <h3 class="step-title">Secure Payment</h3>
                <p class="step-desc">Complete your purchase using our secure payment gateway. We accept multiple payment methods.</p>
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
                    <i class="ph-fill ph-play-circle"></i>
                </div>
                <h3 class="step-title">Start Watching</h3>
                <p class="step-desc">Receive your credentials instantly via email and start enjoying unlimited entertainment.</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">What Our <span class="text-gradient">Customers Say</span></h2>
            <p class="section-subtitle">
                Join thousands of satisfied customers enjoying premium entertainment
            </p>
        </div>
        
        <div class="testimonials-grid">
            @forelse($testimonials as $testimonial)
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="testimonial-rating">
                    @for($i = 0; $i < $testimonial->rating; $i++)
                    <i class="ph-fill ph-star"></i>
                    @endfor
                </div>
                <p class="testimonial-content">{{ $testimonial->content }}</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="ph-fill ph-user"></i>
                    </div>
                    <div class="author-info">
                        <span class="author-name">{{ $testimonial->name }}</span>
                        <span class="author-location">{{ $testimonial->location }}</span>
                    </div>
                </div>
            </div>
            @empty
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="0">
                <div class="testimonial-rating">
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-content">"Best IPTV service I've ever used! The picture quality is amazing and I've never experienced any buffering. Highly recommended!"</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="ph-fill ph-user"></i>
                    </div>
                    <div class="author-info">
                        <span class="author-name">Michael Johnson</span>
                        <span class="author-location">United States</span>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                <div class="testimonial-rating">
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-content">"The channel selection is incredible! I can watch all my favorite sports from around the world. Customer support is also very responsive."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="ph-fill ph-user"></i>
                    </div>
                    <div class="author-info">
                        <span class="author-name">Sarah Williams</span>
                        <span class="author-location">United Kingdom</span>
                    </div>
                </div>
            </div>
            
            <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                <div class="testimonial-rating">
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                    <i class="ph-fill ph-star"></i>
                </div>
                <p class="testimonial-content">"I switched from cable TV to BestLiveIPTV and I'm saving so much money! The VOD library is huge and my whole family loves it."</p>
                <div class="testimonial-author">
                    <div class="author-avatar">
                        <i class="ph-fill ph-user"></i>
                    </div>
                    <div class="author-info">
                        <span class="author-name">David Miller</span>
                        <span class="author-location">Canada</span>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="faq-section" id="faq">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Frequently Asked <span class="text-gradient">Questions</span></h2>
            <p class="section-subtitle">
                Find answers to common questions about our service
            </p>
        </div>
        
        <div class="faq-grid" data-aos="fade-up" data-aos-delay="200">
            @forelse($faqs as $faq)
            <div class="faq-item">
                <button class="faq-question">
                    <span>{{ $faq->question }}</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>{{ $faq->answer }}</p>
                </div>
            </div>
            @empty
            <div class="faq-item">
                <button class="faq-question">
                    <span>What is IPTV and how does it work?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>IPTV (Internet Protocol Television) is a service that delivers television content over the internet. Instead of receiving TV programs through traditional satellite or cable, you stream content directly through your internet connection to any compatible device.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What devices are compatible with your service?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Our service works on Smart TVs, Android devices, iOS (iPhone/iPad), Amazon Fire Stick, MAG boxes, Windows PC, Mac, and most IPTV players. We provide detailed setup guides for all devices.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>How quickly will I receive my subscription?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>After successful payment, you will receive your subscription details instantly via email. In most cases, you can start watching within minutes of completing your purchase.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>Do you offer a free trial?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>Yes! We offer a 36-hour free trial so you can test our service before committing to a subscription. The trial includes full access to all channels and features.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What payment methods do you accept?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>We accept PayPal, Credit/Debit cards through Stripe, and various cryptocurrencies including Bitcoin and Ethereum. All payments are processed securely.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <button class="faq-question">
                    <span>What internet speed do I need?</span>
                    <i class="ph ph-plus"></i>
                </button>
                <div class="faq-answer">
                    <p>For HD content, we recommend at least 10 Mbps. For 4K Ultra HD streaming, a minimum of 25 Mbps is recommended. A stable wired connection is preferred for the best experience.</p>
                </div>
            </div>
            @endforelse
        </div>
        
        <div class="faq-footer" data-aos="fade-up">
            <p>Still have questions?</p>
            <a href="{{ route('contact') }}" class="btn btn-primary">
                <i class="ph ph-chat-centered-dots"></i>
                Contact Support
            </a>
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
            <h2 class="cta-title">Ready to Start <span class="text-gradient">Streaming?</span></h2>
            <p class="cta-subtitle">Join thousands of satisfied customers and experience the best IPTV service today!</p>
            
            <div class="cta-features">
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>No Contract Required</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Instant Activation</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>24/7 Support</span>
                </div>
                <div class="cta-feature">
                    <i class="ph-fill ph-check-circle"></i>
                    <span>Money Back Guarantee</span>
                </div>
            </div>
            
            <div class="cta-buttons">
                @if($freeTrialPackage)
                <a href="{{ route('checkout.show', $freeTrialPackage->slug) }}" class="btn btn-white btn-lg">
                    <i class="ph ph-play-circle"></i>
                    Start Free Trial
                </a>
                @else
                <a href="{{ route('packages.index') }}" class="btn btn-white btn-lg">
                    <i class="ph ph-play-circle"></i>
                    Start Free Trial
                </a>
                @endif
                <a href="{{ route('packages.index') }}" class="btn btn-outline-white btn-lg">
                    <i class="ph ph-shopping-cart"></i>
                    View Plans
                </a>
            </div>
        </div>
    </div>
</section>

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

@endsection
