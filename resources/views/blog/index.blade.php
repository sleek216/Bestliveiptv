@extends('layouts.app')

@section('title', 'Blog - BestLiveIPTV IPTV News & Updates')

@section('content')
<!-- Page Hero Section -->
<section class="page-hero">
    <div class="page-hero-bg">
        <div class="page-hero-pattern"></div>
        <div class="page-hero-glow page-hero-glow-1"></div>
        <div class="page-hero-glow page-hero-glow-2"></div>
    </div>
    
    <div class="container">
        <div class="page-hero-content" style="grid-template-columns: 1fr; text-align: center; justify-items: center;">
            <div class="page-hero-text" data-aos="fade-up">
                <div class="page-hero-badge">
                    <i class="ph-fill ph-newspaper"></i>
                    <span>News & Updates</span>
                </div>
                
                <h1 class="page-hero-title">
                    Latest IPTV <span class="text-gradient">News & Tutorials</span>
                </h1>
                
                <p class="page-hero-subtitle" style="max-width: 650px; margin: 0 auto 2rem;">
                    Stay updated with the latest IPTV industry news, setup tutorials, tips & tricks, 
                    and exclusive updates from BestLiveIPTV.
                </p>
                
                <div class="page-hero-features" style="justify-content: center;">
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-book-open"></i>
                        <span>Setup Guides</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-lightbulb"></i>
                        <span>Tips & Tricks</span>
                    </div>
                    <div class="page-hero-feature">
                        <i class="ph-fill ph-megaphone"></i>
                        <span>Announcements</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Blog Categories -->
<section class="blog-categories-section">
    <div class="container">
        <div class="blog-categories" data-aos="fade-up">
            <button class="category-btn active" data-category="all">
                <i class="ph ph-squares-four"></i>
                All Posts
            </button>
            <button class="category-btn" data-category="tutorials">
                <i class="ph ph-graduation-cap"></i>
                Tutorials
            </button>
            <button class="category-btn" data-category="updates">
                <i class="ph ph-bell-ringing"></i>
                Updates
            </button>
            <button class="category-btn" data-category="tips">
                <i class="ph ph-lightbulb-filament"></i>
                Tips & Tricks
            </button>
            <button class="category-btn" data-category="news">
                <i class="ph ph-newspaper-clipping"></i>
                Industry News
            </button>
        </div>
    </div>
</section>

<!-- Blog Posts Grid -->
<section class="blog-posts-section">
    <div class="container">
        <div class="blog-grid">
            @if($featuredPost)
            <!-- Featured Post -->
            <article class="blog-card blog-card-featured" data-aos="fade-up" data-category="{{ $featuredPost->category }}">
                <div class="blog-card-image">
                    @if($featuredPost->image)
                        <img src="{{ $featuredPost->image }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="blog-image-placeholder">
                            <i class="ph-fill ph-fire"></i>
                        </div>
                    @endif
                    <div class="blog-card-overlay"></div>
                    <span class="blog-category-tag {{ $featuredPost->category }}">
                        @if($featuredPost->is_featured)
                            <i class="ph-fill ph-star"></i>
                            Featured
                        @else
                            {{ ucfirst($featuredPost->category) }}
                        @endif
                    </span>
                </div>
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date">
                            <i class="ph ph-calendar"></i>
                            {{ $featuredPost->published_at ? $featuredPost->published_at->format('M d, Y') : $featuredPost->created_at->format('M d, Y') }}
                        </span>
                        <span class="blog-read-time">
                            <i class="ph ph-clock"></i>
                            {{ $featuredPost->reading_time }}
                        </span>
                    </div>
                    <h2 class="blog-card-title">{{ $featuredPost->title }}</h2>
                    <p class="blog-card-excerpt">
                        {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}
                    </p>
                    <a href="{{ route('blog.show', $featuredPost->slug) }}" class="blog-read-more">
                        Read Full Article
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endif

            @foreach($posts as $index => $post)
            @php
                $colors = ['', 'cyan', 'green', 'purple', 'orange'];
                $icons = ['ph-fire', 'ph-plus-circle', 'ph-rocket-launch', 'ph-android-logo', 'ph-globe', 'ph-apple-logo', 'ph-shield-check'];
                $colorClass = $colors[$index % count($colors)];
                $iconClass = $icons[$index % count($icons)];
            @endphp
            <!-- Regular Post -->
            <article class="blog-card" data-aos="fade-up" data-aos-delay="{{ (($index % 3) + 1) * 50 }}" data-category="{{ $post->category }}">
                <div class="blog-card-image">
                    @if($post->image)
                        <img src="{{ $post->image }}" alt="" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <div class="blog-image-placeholder {{ $colorClass }}">
                            <i class="ph-fill {{ $iconClass }}"></i>
                        </div>
                    @endif
                    <div class="blog-card-overlay"></div>
                    <span class="blog-category-tag {{ $post->category }}">{{ ucfirst($post->category) }}</span>
                </div>
                <div class="blog-card-content">
                    <div class="blog-meta">
                        <span class="blog-date">
                            <i class="ph ph-calendar"></i>
                            {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                        </span>
                        <span class="blog-read-time">
                            <i class="ph ph-clock"></i>
                            {{ $post->reading_time }}
                        </span>
                    </div>
                    <h3 class="blog-card-title">{{ $post->title }}</h3>
                    <p class="blog-card-excerpt">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="blog-read-more">
                        Read More
                        <i class="ph ph-arrow-right"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Load More Button -->
        <div class="blog-load-more" data-aos="fade-up">
            <button class="btn btn-glass btn-lg">
                <i class="ph ph-arrow-clockwise"></i>
                Load More Articles
            </button>
        </div>
    </div>
</section>

<!-- Newsletter Section -->
<section class="blog-newsletter-section">
    <div class="container">
        <div class="newsletter-card" data-aos="fade-up">
            <div class="newsletter-icon">
                <i class="ph-fill ph-envelope-simple"></i>
            </div>
            <h2 class="newsletter-title">Stay Updated</h2>
            <p class="newsletter-desc">Subscribe to our newsletter for the latest IPTV news, tutorials, and exclusive offers.</p>
            <form class="newsletter-form">
                <div class="newsletter-input-wrapper">
                    <input type="email" placeholder="Enter your email address" class="newsletter-input" required>
                    <button type="submit" class="btn btn-primary">
                        <i class="ph ph-paper-plane-tilt"></i>
                        Subscribe
                    </button>
                </div>
            </form>
            <p class="newsletter-note">
                <i class="ph ph-shield-check"></i>
                We respect your privacy. Unsubscribe at any time.
            </p>
        </div>
    </div>
</section>

<style>
/* Blog Categories Section */
.blog-categories-section {
    padding: 2rem 0;
    background: var(--gray-50);
    border-bottom: 1px solid var(--gray-200);
}

.blog-categories {
    display: flex;
    flex-wrap: wrap;
    gap: 0.75rem;
    justify-content: center;
}

.category-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1.25rem;
    background: var(--white);
    border: 1px solid var(--gray-200);
    border-radius: var(--radius-full);
    font-size: 0.875rem;
    font-weight: 500;
    color: var(--gray-600);
    cursor: pointer;
    transition: all var(--transition-base);
}

.category-btn:hover {
    border-color: var(--primary-500);
    color: var(--primary-600);
    background: var(--primary-50);
}

.category-btn.active {
    background: var(--gradient-primary);
    color: var(--white);
    border-color: transparent;
}

.category-btn i {
    font-size: 1.125rem;
}

/* Blog Posts Section */
.blog-posts-section {
    padding: 4rem 0;
    background: var(--gray-50);
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 2rem;
}

/* Featured Post spans 2 columns on larger screens */
.blog-card-featured {
    grid-column: span 2;
    grid-row: span 2;
}

/* Blog Card */
.blog-card {
    background: var(--white);
    border-radius: var(--radius-xl);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all var(--transition-base);
    border: 1px solid var(--gray-100);
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl);
}

.blog-card-image {
    position: relative;
    overflow: hidden;
    height: 200px;
}

.blog-card-featured .blog-card-image {
    height: 100%;
    min-height: 400px;
}

.blog-image-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-500), var(--primary-700));
    display: flex;
    align-items: center;
    justify-content: center;
}

.blog-image-placeholder i {
    font-size: 4rem;
    color: rgba(255, 255, 255, 0.3);
}

.blog-card-featured .blog-image-placeholder i {
    font-size: 6rem;
}

.blog-image-placeholder.cyan {
    background: linear-gradient(135deg, var(--secondary-500), #0077b6);
}

.blog-image-placeholder.green {
    background: linear-gradient(135deg, #10b981, #059669);
}

.blog-image-placeholder.purple {
    background: linear-gradient(135deg, #8b5cf6, #6d28d9);
}

.blog-image-placeholder.orange {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}

.blog-card-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.3) 100%);
    opacity: 0;
    transition: opacity var(--transition-base);
}

.blog-card:hover .blog-card-overlay {
    opacity: 1;
}

.blog-category-tag {
    position: absolute;
    top: 1rem;
    left: 1rem;
    padding: 0.375rem 0.875rem;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--white);
    text-transform: uppercase;
    letter-spacing: 0.03em;
}

.blog-category-tag.featured {
    background: linear-gradient(135deg, #f59e0b, #d97706);
    display: flex;
    align-items: center;
    gap: 0.375rem;
}

.blog-category-tag.tutorials {
    background: linear-gradient(135deg, var(--primary-500), var(--primary-600));
}

.blog-category-tag.updates {
    background: linear-gradient(135deg, var(--secondary-500), var(--secondary-600));
}

.blog-category-tag.tips {
    background: linear-gradient(135deg, #10b981, #059669);
}

.blog-category-tag.news {
    background: linear-gradient(135deg, #8b5cf6, #6d28d9);
}

.blog-card-content {
    padding: 1.5rem;
}

.blog-card-featured .blog-card-content {
    padding: 2rem;
}

.blog-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 0.875rem;
}

.blog-date,
.blog-read-time {
    display: flex;
    align-items: center;
    gap: 0.375rem;
    font-size: 0.8125rem;
    color: var(--gray-500);
}

.blog-date i,
.blog-read-time i {
    font-size: 0.875rem;
}

.blog-card-title {
    font-family: var(--font-display);
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
    line-height: 1.4;
    margin-bottom: 0.75rem;
    transition: color var(--transition-base);
}

.blog-card-featured .blog-card-title {
    font-size: 1.5rem;
}

.blog-card:hover .blog-card-title {
    color: var(--primary-600);
}

.blog-card-excerpt {
    font-size: 0.9375rem;
    color: var(--gray-600);
    line-height: 1.6;
    margin-bottom: 1.25rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.blog-card-featured .blog-card-excerpt {
    -webkit-line-clamp: 4;
}

.blog-read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--primary-600);
    text-decoration: none;
    transition: gap var(--transition-base);
}

.blog-read-more:hover {
    gap: 0.75rem;
}

.blog-read-more i {
    transition: transform var(--transition-base);
}

.blog-read-more:hover i {
    transform: translateX(3px);
}

/* Load More */
.blog-load-more {
    text-align: center;
    margin-top: 3rem;
}

/* Newsletter Section */
.blog-newsletter-section {
    padding: 4rem 0 6rem;
    background: var(--gray-50);
}

.newsletter-card {
    background: linear-gradient(135deg, var(--gray-900), var(--black));
    border-radius: var(--radius-2xl);
    padding: 3.5rem;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.newsletter-card::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 102, 255, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.newsletter-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: var(--gradient-primary);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: var(--white);
}

.newsletter-title {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: var(--white);
    margin-bottom: 0.75rem;
}

.newsletter-desc {
    font-size: 1.0625rem;
    color: var(--gray-400);
    max-width: 500px;
    margin: 0 auto 2rem;
}

.newsletter-form {
    max-width: 500px;
    margin: 0 auto;
}

.newsletter-input-wrapper {
    display: flex;
    gap: 0.75rem;
    background: rgba(255, 255, 255, 0.1);
    padding: 0.5rem;
    border-radius: var(--radius-xl);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.newsletter-input {
    flex: 1;
    padding: 0.875rem 1.25rem;
    background: transparent;
    border: none;
    font-size: 1rem;
    color: var(--white);
    outline: none;
}

.newsletter-input::placeholder {
    color: var(--gray-500);
}

.newsletter-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    margin-top: 1rem;
    font-size: 0.8125rem;
    color: var(--gray-500);
}

.newsletter-note i {
    color: var(--success);
}

/* Responsive */
@media (max-width: 1024px) {
    .blog-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .blog-card-featured {
        grid-column: span 2;
        grid-row: span 1;
    }
    
    .blog-card-featured .blog-card-image {
        min-height: 250px;
    }
}

@media (max-width: 768px) {
    .blog-grid {
        grid-template-columns: 1fr;
    }
    
    .blog-card-featured {
        grid-column: span 1;
    }
    
    .blog-categories {
        justify-content: flex-start;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        -webkit-overflow-scrolling: touch;
    }
    
    .category-btn {
        flex-shrink: 0;
    }
    
    .newsletter-card {
        padding: 2rem;
    }
    
    .newsletter-input-wrapper {
        flex-direction: column;
    }
    
    .newsletter-input-wrapper .btn {
        width: 100%;
    }
}
</style>

@push('scripts')
<script>
// Category Filter
document.querySelectorAll('.category-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Update active state
        document.querySelectorAll('.category-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const category = this.dataset.category;
        const cards = document.querySelectorAll('.blog-card');
        
        cards.forEach(card => {
            if (category === 'all' || card.dataset.category === category) {
                card.style.display = 'block';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    });
});
</script>
@endpush
@endsection
