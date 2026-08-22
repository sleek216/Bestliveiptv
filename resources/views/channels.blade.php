@extends('layouts.app')

@section('title', 'Live TV Channels - BestLiveIPTV')

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
                    20,000+ Live <span class="text-gradient">Channels</span>
                </h1>
                
                <p class="page-hero-subtitle">
                    Access premium live TV channels from over 150 countries. 
                    Sports, movies, news, entertainment, and more in HD & 4K quality.
                </p>
                
                <div class="page-hero-features">
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-globe"></i>
                        <span>150+ Countries</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-film-strip"></i>
                        <span>100,000 VOD</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-play-circle"></i>
                        <span>Live Sports</span>
                    </div>
                </div>
            </div>
            
            <div class="page-hero-visual" data-aos="fade-left" data-aos-delay="200">
                <div class="page-hero-image">
                    <div class="page-hero-image-wrapper">
                        <img src="https://images.unsplash.com/photo-1593784991095-a205069470b6?w=600&h=400&fit=crop" 
                             alt="Live TV Channels" 
                             class="page-hero-img"
                             loading="lazy">
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-1">
                        <div class="page-hero-floating-icon blue">
                            <i class="ph-fill ph-television-simple"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">20K+</span>
                            <span class="page-hero-floating-label">Channels</span>
                        </div>
                    </div>
                    
                    <div class="page-hero-floating page-hero-floating-2">
                        <div class="page-hero-floating-icon cyan">
                            <i class="ph-fill ph-broadcast"></i>
                        </div>
                        <div class="page-hero-floating-text">
                            <span class="page-hero-floating-value">4K</span>
                            <span class="page-hero-floating-label">Quality</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Channel Categories -->
<section class="channels-section">
    <div class="container">
        <!-- Category Filter -->
        <div class="filter-bar" data-aos="fade-up">
            <div class="filter-tabs">
                <button class="filter-tab active" data-category="all">
                    <i class="ph ph-squares-four"></i> All Categories
                </button>
                <button class="filter-tab" data-category="sports">
                    <i class="ph ph-soccer-ball"></i> Sports
                </button>
                <button class="filter-tab" data-category="movies">
                    <i class="ph ph-film-slate"></i> Movies
                </button>
                <button class="filter-tab" data-category="news">
                    <i class="ph ph-newspaper"></i> News
                </button>
                <button class="filter-tab" data-category="entertainment">
                    <i class="ph ph-star"></i> Entertainment
                </button>
                <button class="filter-tab" data-category="kids">
                    <i class="ph ph-baby"></i> Kids
                </button>
                <button class="filter-tab" data-category="documentary">
                    <i class="ph ph-globe-hemisphere-west"></i> Documentary
                </button>
            </div>
            <div class="search-box">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" placeholder="Search channels..." id="channelSearch">
            </div>
        </div>
        
        <!-- Categories Grid -->
        <div class="categories-grid">
            <!-- Sports -->
            <div class="category-card" data-category="sports" data-aos="fade-up">
                <div class="category-header">
                    <div class="category-icon sports">
                        <i class="ph-fill ph-soccer-ball"></i>
                    </div>
                    <div class="category-info">
                        <h3>Sports Channels</h3>
                        <span>2,500+ channels</span>
                    </div>
                </div>
                <div class="channel-logos">
                    <div class="logo-item"><span>ESPN</span></div>
                    <div class="logo-item"><span>beIN</span></div>
                    <div class="logo-item"><span>Sky Sports</span></div>
                    <div class="logo-item"><span>FOX</span></div>
                    <div class="logo-item"><span>NBC</span></div>
                    <div class="logo-item more">+500</div>
                </div>
                <ul class="channel-features">
                    <li><i class="ph-fill ph-check-circle"></i> Premier League, La Liga, Serie A</li>
                    <li><i class="ph-fill ph-check-circle"></i> NFL, NBA, MLB, NHL</li>
                    <li><i class="ph-fill ph-check-circle"></i> UFC, Boxing, WWE</li>
                    <li><i class="ph-fill ph-check-circle"></i> Live PPV Events</li>
                </ul>
            </div>
            
            <!-- Movies -->
            <div class="category-card" data-category="movies" data-aos="fade-up" data-aos-delay="100">
                <div class="category-header">
                    <div class="category-icon movies">
                        <i class="ph-fill ph-film-slate"></i>
                    </div>
                    <div class="category-info">
                        <h3>Movies & Series</h3>
                        <span>50,000+ VOD</span>
                    </div>
                </div>
                <div class="channel-logos">
                    <div class="logo-item"><span>HBO</span></div>
                    <div class="logo-item"><span>Netflix</span></div>
                    <div class="logo-item"><span>AMC</span></div>
                    <div class="logo-item"><span>FX</span></div>
                    <div class="logo-item"><span>Showtime</span></div>
                    <div class="logo-item more">+1000</div>
                </div>
                <ul class="channel-features">
                    <li><i class="ph-fill ph-check-circle"></i> Latest Hollywood Movies</li>
                    <li><i class="ph-fill ph-check-circle"></i> Complete TV Series</li>
                    <li><i class="ph-fill ph-check-circle"></i> 4K Ultra HD Quality</li>
                    <li><i class="ph-fill ph-check-circle"></i> Multi-language Subtitles</li>
                </ul>
            </div>
            
            <!-- News -->
            <div class="category-card" data-category="news" data-aos="fade-up" data-aos-delay="200">
                <div class="category-header">
                    <div class="category-icon news">
                        <i class="ph-fill ph-newspaper"></i>
                    </div>
                    <div class="category-info">
                        <h3>News Channels</h3>
                        <span>800+ channels</span>
                    </div>
                </div>
                <div class="channel-logos">
                    <div class="logo-item"><span>CNN</span></div>
                    <div class="logo-item"><span>BBC</span></div>
                    <div class="logo-item"><span>Al Jazeera</span></div>
                    <div class="logo-item"><span>Fox News</span></div>
                    <div class="logo-item"><span>MSNBC</span></div>
                    <div class="logo-item more">+200</div>
                </div>
                <ul class="channel-features">
                    <li><i class="ph-fill ph-check-circle"></i> 24/7 Live News Coverage</li>
                    <li><i class="ph-fill ph-check-circle"></i> Global News Networks</li>
                    <li><i class="ph-fill ph-check-circle"></i> Business & Finance</li>
                    <li><i class="ph-fill ph-check-circle"></i> Local & Regional News</li>
                </ul>
            </div>
            
            <!-- Entertainment -->
            <div class="category-card" data-category="entertainment" data-aos="fade-up">
                <div class="category-header">
                    <div class="category-icon entertainment">
                        <i class="ph-fill ph-star"></i>
                    </div>
                    <div class="category-info">
                        <h3>Entertainment</h3>
                        <span>5,000+ channels</span>
                    </div>
                </div>
                <div class="channel-logos">
                    <div class="logo-item"><span>E!</span></div>
                    <div class="logo-item"><span>MTV</span></div>
                    <div class="logo-item"><span>Comedy</span></div>
                    <div class="logo-item"><span>TLC</span></div>
                    <div class="logo-item"><span>Bravo</span></div>
                    <div class="logo-item more">+1500</div>
                </div>
                <ul class="channel-features">
                    <li><i class="ph-fill ph-check-circle"></i> Reality TV Shows</li>
                    <li><i class="ph-fill ph-check-circle"></i> Talk Shows & Comedy</li>
                    <li><i class="ph-fill ph-check-circle"></i> Music & Concerts</li>
                    <li><i class="ph-fill ph-check-circle"></i> Lifestyle & Travel</li>
                </ul>
            </div>
            
            <!-- Kids -->
            <div class="category-card" data-category="kids" data-aos="fade-up" data-aos-delay="100">
                <div class="category-header">
                    <div class="category-icon kids">
                        <i class="ph-fill ph-baby"></i>
                    </div>
                    <div class="category-info">
                        <h3>Kids & Family</h3>
                        <span>1,000+ channels</span>
                    </div>
                </div>
                <div class="channel-logos">
                    <div class="logo-item"><span>Disney</span></div>
                    <div class="logo-item"><span>Nick</span></div>
                    <div class="logo-item"><span>Cartoon</span></div>
                    <div class="logo-item"><span>PBS</span></div>
                    <div class="logo-item"><span>BabyTV</span></div>
                    <div class="logo-item more">+300</div>
                </div>
                <ul class="channel-features">
                    <li><i class="ph-fill ph-check-circle"></i> Family-Friendly Content</li>
                    <li><i class="ph-fill ph-check-circle"></i> Educational Programs</li>
                    <li><i class="ph-fill ph-check-circle"></i> Cartoons & Animation</li>
                    <li><i class="ph-fill ph-check-circle"></i> Parental Controls</li>
                </ul>
            </div>
            
            <!-- Documentary -->
            <div class="category-card" data-category="documentary" data-aos="fade-up" data-aos-delay="200">
                <div class="category-header">
                    <div class="category-icon documentary">
                        <i class="ph-fill ph-globe-hemisphere-west"></i>
                    </div>
                    <div class="category-info">
                        <h3>Documentary</h3>
                        <span>600+ channels</span>
                    </div>
                </div>
                <div class="channel-logos">
                    <div class="logo-item"><span>Discovery</span></div>
                    <div class="logo-item"><span>Nat Geo</span></div>
                    <div class="logo-item"><span>History</span></div>
                    <div class="logo-item"><span>Animal</span></div>
                    <div class="logo-item"><span>Science</span></div>
                    <div class="logo-item more">+100</div>
                </div>
                <ul class="channel-features">
                    <li><i class="ph-fill ph-check-circle"></i> Nature & Wildlife</li>
                    <li><i class="ph-fill ph-check-circle"></i> History & Science</li>
                    <li><i class="ph-fill ph-check-circle"></i> True Crime</li>
                    <li><i class="ph-fill ph-check-circle"></i> Travel & Adventure</li>
                </ul>
            </div>
        </div>
        
        </div>

        <!-- Full Channel Lineup -->
        <div class="full-lineup-section" id="fullLineup" data-aos="fade-up">
            <div class="section-header text-center mb-4">
                <h2>Complete Channel Lineup</h2>
                <p>Browse our complete list of available channels</p>
            </div>

            <div class="lineup-controls">
                <div class="search-box large">
                    <i class="ph ph-magnifying-glass"></i>
                    <input type="text" id="lineupSearch" placeholder="Search specific channel (e.g. 'Sky Sports')">
                </div>
                <div class="category-pills">
                    <button class="pill active" data-filter="all">All</button>
                    <button class="pill" data-filter="Sports">Sports</button>
                    <button class="pill" data-filter="Movies">Movies</button>
                    <button class="pill" data-filter="News">News</button>
                    <button class="pill" data-filter="Kids">Kids</button>
                    <button class="pill" data-filter="Adult">Adult 18+</button>
                </div>
            </div>

            <div class="channels-list-container">
                <div class="channels-grid-dense" id="channelsGridDense">
                    <!-- Populated by JS -->
                    <div class="channel-loader">
                        <div class="spinner"></div> Loading channels...
                    </div>
                </div>
            </div>
            
            <div class="text-center mt-4">
                <button id="loadMoreBtn" class="btn btn-outline btn-wide">
                    Load More Channels <span id="showingCount" class="text-muted ms-1">(Showing 0 of 20,000+)</span>
                </button>
            </div>
        </div>
        
        <!-- Country Coverage -->
        <div class="countries-section" data-aos="fade-up">
            <div class="section-header">
                <h2>Worldwide Coverage</h2>
                <p>Access channels from over 150 countries across the globe</p>
            </div>
            
            <div class="countries-grid">
                <div class="country-item">
                    <span class="flag">🇺🇸</span>
                    <span class="name">USA</span>
                    <span class="count">3000+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇬🇧</span>
                    <span class="name">UK</span>
                    <span class="count">2000+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇨🇦</span>
                    <span class="name">Canada</span>
                    <span class="count">1500+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇩🇪</span>
                    <span class="name">Germany</span>
                    <span class="count">1000+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇫🇷</span>
                    <span class="name">France</span>
                    <span class="count">1000+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇪🇸</span>
                    <span class="name">Spain</span>
                    <span class="count">800+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇮🇹</span>
                    <span class="name">Italy</span>
                    <span class="count">800+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇳🇱</span>
                    <span class="name">Netherlands</span>
                    <span class="count">600+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇵🇹</span>
                    <span class="name">Portugal</span>
                    <span class="count">500+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇧🇷</span>
                    <span class="name">Brazil</span>
                    <span class="count">1000+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇸🇦</span>
                    <span class="name">Arabic</span>
                    <span class="count">2000+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇮🇳</span>
                    <span class="name">India</span>
                    <span class="count">1500+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇹🇷</span>
                    <span class="name">Turkey</span>
                    <span class="count">800+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇵🇰</span>
                    <span class="name">Pakistan</span>
                    <span class="count">600+</span>
                </div>
                <div class="country-item">
                    <span class="flag">🇦🇫</span>
                    <span class="name">Afghan</span>
                    <span class="count">300+</span>
                </div>
                <div class="country-item more">
                    <span class="flag">🌍</span>
                    <span class="name">More</span>
                    <span class="count">+135</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="channels-cta">
    <div class="container">
        <div class="cta-content" data-aos="fade-up">
            <h2>Ready to Start Watching?</h2>
            <p>Get instant access to 20,000+ channels starting at just $9.99/month</p>
            <div class="cta-buttons">
                <a href="{{ route('packages.index') }}" class="btn btn-primary btn-lg">
                    <i class="ph ph-shopping-cart"></i>
                    View Pricing Plans
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
        max-width: 800px;
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
        margin-bottom: 2rem;
    }
    
    .hero-stats {
        display: flex;
        justify-content: center;
        gap: 3rem;
    }
    
    .hero-stats .stat {
        text-align: center;
    }
    
    .hero-stats .stat-number {
        display: block;
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 800;
        background: var(--gradient-primary);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .hero-stats .stat-label {
        font-size: 0.875rem;
        color: rgba(255, 255, 255, 0.6);
    }
    
    .channels-section {
        padding: 4rem 0;
        background: var(--gray-50);
    }
    
    .filter-bar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        padding: 1rem;
        background: var(--white);
        border-radius: var(--radius-xl);
        box-shadow: var(--shadow-md);
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .filter-tabs {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .filter-tab {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.625rem 1rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: var(--gray-600);
        background: var(--gray-50);
        border: none;
        border-radius: var(--radius-lg);
        cursor: pointer;
        transition: var(--transition-base);
    }
    
    .filter-tab:hover {
        background: var(--gray-100);
    }
    
    .filter-tab.active {
        background: var(--primary-500);
        color: var(--white);
    }
    
    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0 1rem;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        min-width: 250px;
    }
    
    .search-box i {
        color: var(--gray-400);
    }
    
    .search-box input {
        flex: 1;
        padding: 0.625rem 0;
        border: none;
        background: transparent;
        font-size: 0.875rem;
    }
    
    .categories-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(360px, 1fr));
        gap: 1.5rem;
        margin-bottom: 4rem;
    }
    
    .category-card {
        background: var(--white);
        border-radius: var(--radius-xl);
        padding: 1.5rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-100);
        transition: var(--transition-base);
    }
    
    .category-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }
    
    .category-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .category-icon {
        width: 60px;
        height: 60px;
        border-radius: var(--radius-xl);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: var(--white);
    }
    
    .category-icon.sports { background: linear-gradient(135deg, #10b981, #059669); }
    .category-icon.movies { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .category-icon.news { background: linear-gradient(135deg, #ef4444, #dc2626); }
    .category-icon.entertainment { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .category-icon.kids { background: linear-gradient(135deg, #ec4899, #db2777); }
    .category-icon.documentary { background: linear-gradient(135deg, #0ea5e9, #0284c7); }
    
    .category-info h3 {
        font-family: var(--font-display);
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--gray-900);
    }
    
    .category-info span {
        font-size: 0.875rem;
        color: var(--gray-500);
    }
    
    .channel-logos {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    
    .logo-item {
        padding: 0.5rem 0.75rem;
        background: var(--gray-100);
        border-radius: var(--radius-md);
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray-700);
    }
    
    .logo-item.more {
        background: var(--primary-50);
        color: var(--primary-600);
    }
    
    .channel-features {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }
    
    .channel-features li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: var(--gray-600);
    }
    
    .channel-features li i {
        color: var(--success-500);
    }
    
    /* Countries */
    .countries-section {
        background: var(--white);
        border-radius: var(--radius-2xl);
        padding: 2.5rem;
        box-shadow: var(--shadow-lg);
    }
    
    .countries-section .section-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .countries-section h2 {
        font-family: var(--font-display);
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--gray-900);
        margin-bottom: 0.5rem;
    }
    
    .countries-section p {
        color: var(--gray-500);
    }
    
    .countries-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(140px, 1fr));
        gap: 1rem;
    }
    
    .country-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 1rem;
        background: var(--gray-50);
        border-radius: var(--radius-lg);
        transition: var(--transition-base);
    }
    
    .country-item:hover {
        background: var(--primary-50);
    }
    
    .country-item .flag {
        font-size: 2rem;
        margin-bottom: 0.5rem;
    }
    
    .country-item .name {
        font-weight: 600;
        color: var(--gray-900);
        font-size: 0.875rem;
    }
    
    .country-item .count {
        font-size: 0.75rem;
        color: var(--primary-500);
    }
    
    .country-item.more {
        background: var(--gradient-primary);
    }
    
    .country-item.more .name,
    .country-item.more .count {
        color: var(--white);
    }
    
    /* CTA */
    .channels-cta {
        padding: 5rem 0;
        background: var(--gradient-primary);
        text-align: center;
        color: var(--white);
    }
    
    .channels-cta h2 {
        font-family: var(--font-display);
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
    }
    
    .channels-cta p {
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
        /* Full Lineup Styles */
        .full-lineup-section { padding: 4rem 0; background: #fff; border-top: 1px solid var(--gray-100); }
        .lineup-controls { display: flex; flex-direction: column; align-items: center; gap: 1.5rem; margin-bottom: 2.5rem; }
        .search-box.large { width: 100%; max-width: 500px; padding: 0.8rem 1.5rem; background: var(--gray-50); border-radius: 99px; display: flex; align-items: center; gap: 1rem; border: 1px solid var(--gray-200); transition: border-color 0.2s; }
        .search-box.large:focus-within { border-color: var(--primary-500); box-shadow: 0 0 0 3px var(--primary-100); }
        .search-box.large input { font-size: 1rem; width: 100%; border:none; background:transparent; outline:none; color: var(--gray-800); }
        .category-pills { display: flex; flex-wrap: wrap; justify-content: center; gap: 0.5rem; }
        .pill { padding: 0.5rem 1.25rem; border-radius: 99px; border: 1px solid var(--gray-200); background: #fff; cursor: pointer; transition: all 0.2s; font-size: 0.9rem; font-weight: 500; color: var(--gray-600); }
        .pill:hover { background: var(--gray-50); border-color: var(--gray-300); }
        .pill.active { background: var(--primary-500); color: #fff; border-color: var(--primary-500); }
        .channels-list-container { min-height: 400px; margin-bottom: 2rem; }
        .channels-grid-dense { display: grid; grid-template-columns: repeat(auto-fill, minmax(180px, 1fr)); gap: 1rem; }
        .channel-item { padding: 0.75rem 1rem; background: var(--gray-50); border: 1px solid var(--gray-100); border-radius: var(--radius-lg); font-size: 0.9rem; font-weight: 500; color: var(--gray-800); text-align: left; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: flex; align-items: center; gap: 0.75rem; transition: all 0.2s; }
        .channel-item i { color: var(--primary-500); font-size: 1.1em; flex-shrink: 0; }
        .channel-item:hover { border-color: var(--primary-300); background: #fff; box-shadow: var(--shadow-md); transform: translateY(-2px); }
        .channel-loader { grid-column: 1 / -1; text-align: center; padding: 2rem; color: var(--gray-500); }
        .btn-wide { min-width: 200px; }
    @media (max-width: 768px) {
        .page-hero {
            padding: 140px 0 60px;
        }
        
        .hero-stats {
            gap: 1.5rem;
        }
        
        .hero-stats .stat-number {
            font-size: 1.5rem;
        }
        
        .filter-bar {
            flex-direction: column;
        }
        
        .filter-tabs {
            justify-content: center;
        }
        
        .search-box {
            width: 100%;
        }
        
        .categories-grid {
            grid-template-columns: 1fr;
        }
        
        .countries-grid {
            grid-template-columns: repeat(3, 1fr);
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const grid = document.getElementById('channelsGridDense');
        const loadMoreBtn = document.getElementById('loadMoreBtn');
        const searchInput = document.getElementById('lineupSearch');
        const countSpan = document.getElementById('showingCount');
        const pills = document.querySelectorAll('.pill');

        let allChannels = [];
        let displayedCount = 0;
        let currentFilter = 'all';
        let searchQuery = '';
        const CHUNK_SIZE = 120; // Show 120 at a time

        // 1. Generate Dummy Data (Simulating 20,000 channels)
        function generateChannels() {
            const categories = {
                'Sports': ['ESPN', 'Fox Sports', 'Sky Sports', 'beIN Sports', 'Eurosport', 'BT Sport', 'NBC Sports', 'CBS Sports', 'Willow', 'Star Sports', 'DAZN'],
                'Movies': ['HBO', 'Sky Cinema', 'Starz', 'Showtime', 'Cinemax', 'AMC', 'TCM', 'Film4', 'Action Max', 'Drama Ch', 'Netflix Linear'],
                'News': ['CNN', 'BBC News', 'Fox News', 'Al Jazeera', 'MSNBC', 'CNBC', 'Sky News', 'France 24', 'RT', 'EuroNews', 'Bloomberg'],
                'Kids': ['Disney Channel', 'Nickelodeon', 'Cartoon Network', 'Boomerang', 'PBS Kids', 'BabyTV', 'CBeebies', 'Nick Jr.', 'Disney Junior', 'CBBC'],
                'Adult': ['Adult Channel', 'Late Night', 'Midnight Club'],
                'Entertainment': ['E!', 'MTV', 'Comedy Central', 'TLC', 'Bravo', 'Discovery', 'History', 'Nat Geo', 'Animal Planet']
            };

            const list = [];
            
            Object.keys(categories).forEach(cat => {
                const prefixes = categories[cat];
                prefixes.forEach(prefix => {
                    // Standard
                    list.push({ name: prefix, category: cat });
                    list.push({ name: prefix + ' HD', category: cat });
                    list.push({ name: prefix + ' FHD', category: cat });
                    list.push({ name: prefix + ' 4K', category: cat });
                    
                    // Numbered variants (simulating many channels)
                    for(let i=1; i<=15; i++) {
                        list.push({ name: `${prefix} ${i} HD`, category: cat });
                    }
                });
                
                // Generic fillers to reach high numbers
                for(let i=1; i<=150; i++) {
                    list.push({ name: `${cat} Network ${i} HD`, category: cat });
                }
            });

            // Add country specific generic
            const countries = ['USA', 'UK', 'CA', 'DE', 'FR', 'IT', 'ES', 'TR', 'AR', 'IN', 'PK'];
            countries.forEach(code => {
                 for(let i=1; i<=100; i++) {
                     list.push({ name: `Local ${code} Channel ${i}`, category: 'News' });
                 }
            });

            return list.sort(() => Math.random() - 0.5); // Shuffle
        }

        allChannels = generateChannels();
        
        // 2. Render Function
        function renderChannels(append = false) {
            if (!append) {
                grid.innerHTML = '';
                displayedCount = 0;
            }

            // Filter logic
            let filtered = allChannels.filter(ch => {
                const matchesCat = currentFilter === 'all' || ch.category === currentFilter;
                const matchesSearch = ch.name.toLowerCase().includes(searchQuery.toLowerCase());
                return matchesCat && matchesSearch;
            });

            // Pagination logic
            const toShow = filtered.slice(displayedCount, displayedCount + CHUNK_SIZE);
            
            if (toShow.length === 0 && !append) {
                grid.innerHTML = '<div class="channel-loader">No channels found matching your criteria.</div>';
                loadMoreBtn.style.display = 'none';
                return;
            }

            toShow.forEach(ch => {
                const div = document.createElement('div');
                div.className = 'channel-item';
                div.innerHTML = `<i class="ph-fill ph-television"></i> ${ch.name}`;
                div.title = ch.name;
                grid.appendChild(div);
            });

            displayedCount += toShow.length;
            
            // Update button/count
            countSpan.textContent = `(Showing ${displayedCount} of ${filtered.length})`;
            
            if (displayedCount >= filtered.length) {
                loadMoreBtn.style.display = 'none';
            } else {
                loadMoreBtn.style.display = 'inline-block';
            }
        }

        // Initial Load
        renderChannels();

        // Event Listeners
        loadMoreBtn.addEventListener('click', () => renderChannels(true));

        searchInput.addEventListener('input', (e) => {
            searchQuery = e.target.value;
            renderChannels(false);
        });

        pills.forEach(pill => {
            pill.addEventListener('click', () => {
                pills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                currentFilter = pill.dataset.filter;
                renderChannels(false);
            });
        });
    });

    // Existing Category filter (keep it separate or merge if needed)
    document.querySelectorAll('.filter-tab').forEach(tab => {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');
            
            const category = this.dataset.category;
            
            document.querySelectorAll('.category-card').forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Search
    document.getElementById('channelSearch').addEventListener('input', function() {
        const query = this.value.toLowerCase();
        document.querySelectorAll('.category-card').forEach(card => {
            const text = card.textContent.toLowerCase();
            card.style.display = text.includes(query) ? 'block' : 'none';
        });
    });
</script>
@endpush
@endsection
