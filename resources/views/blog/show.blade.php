@extends('layouts.app')

@section('title', $post->title . ' - BestLiveIPTV Blog')

@section('content')
<!-- Page Hero Section -->
<section class="page-hero" style="padding-bottom: 2rem;">
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
                    <span>{{ ucfirst($post->category) }}</span>
                </div>
                
                <h1 class="page-hero-title" style="max-width: 800px; margin: 0 auto 1.5rem; font-size: 2.5rem;">
                    {{ $post->title }}
                </h1>
                
                <div class="d-flex align-items-center justify-content-center gap-4 text-muted flex-wrap" style="font-size: 0.95rem;">
                    <span>
                        <i class="ph ph-calendar me-1"></i>
                        {{ $post->published_at ? $post->published_at->format('M d, Y') : $post->created_at->format('M d, Y') }}
                    </span>
                    <span>
                        <i class="ph ph-clock me-1"></i>
                        {{ $post->reading_time }}
                    </span>
                    <a href="{{ route('blog.index') }}" class="text-primary text-decoration-none">
                        <i class="ph ph-arrow-left me-1"></i>Back to Blog
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Section -->
<section class="article-section py-5" style="background: var(--dark-bg, #0f172a); min-height: 50vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                @if($post->image)
                <div class="mb-5 rounded-4 overflow-hidden shadow-lg" data-aos="fade-up">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-100" style="max-height: 450px; object-fit: cover;">
                </div>
                @endif

                <div class="article-content bg-dark-subtle p-4 p-md-5 rounded-4 shadow-sm border border-secondary border-opacity-25 text-light" data-aos="fade-up">
                    <div class="markdown-body">
                        {!! Str::markdown($post->content) !!}
                    </div>
                </div>

                <!-- Share / Author box -->
                <div class="mt-5 p-4 rounded-4 bg-secondary bg-opacity-10 border border-secondary border-opacity-25 d-flex align-items-center justify-content-between flex-wrap gap-3" data-aos="fade-up">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="width: 50px; height: 50px; font-size: 1.25rem;">
                            IPTV
                        </div>
                        <div>
                            <h6 class="mb-0 text-white fw-bold">Best Live IPTV Editorial Team</h6>
                            <small class="text-muted">Expert streaming guides & tutorials</small>
                        </div>
                    </div>
                    <div>
                        <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">
                            <i class="ph ph-list me-2"></i>All Articles
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if($relatedPosts->count() > 0)
<!-- Related Posts Section -->
<section class="py-5" style="background: rgba(0,0,0,0.2);">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-white fw-bold mb-0">Related Articles</h3>
            <a href="{{ route('blog.index') }}" class="text-primary text-decoration-none">View All <i class="ph ph-arrow-right"></i></a>
        </div>
        <div class="row g-4">
            @foreach($relatedPosts as $index => $relPost)
            @php
                $colors = ['cyan', 'green', 'purple', 'orange'];
                $icons = ['ph-fire', 'ph-plus-circle', 'ph-rocket-launch', 'ph-android-logo'];
                $colorClass = $colors[$index % count($colors)];
                $iconClass = $icons[$index % count($icons)];
            @endphp
            <div class="col-md-4">
                <article class="blog-card h-100" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); border-radius: 1rem; overflow: hidden; display: flex; flex-direction: column;">
                    <div class="blog-card-image" style="position: relative; height: 180px; background: rgba(255,255,255,0.05);">
                        @if($relPost->image)
                            <img src="{{ $relPost->image }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div class="d-flex align-items-center justify-content-center h-100 text-{{ $colorClass }}" style="font-size: 3rem;">
                                <i class="ph-fill {{ $iconClass }}"></i>
                            </div>
                        @endif
                        <span class="badge bg-primary position-absolute top-0 end-0 m-3">{{ ucfirst($relPost->category) }}</span>
                    </div>
                    <div class="p-4 d-flex flex-column flex-grow-1">
                        <small class="text-muted mb-2"><i class="ph ph-clock me-1"></i>{{ $relPost->reading_time }}</small>
                        <h5 class="text-white mb-3 fw-bold">{{ Str::limit($relPost->title, 60) }}</h5>
                        <p class="text-muted small mb-4 flex-grow-1">{{ Str::limit($relPost->excerpt ?? strip_tags($relPost->content), 90) }}</p>
                        <a href="{{ route('blog.show', $relPost->slug) }}" class="text-primary text-decoration-none fw-bold mt-auto">Read Article <i class="ph ph-arrow-right"></i></a>
                    </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
.markdown-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #e2e8f0;
}
.markdown-body h1, .markdown-body h2, .markdown-body h3, .markdown-body h4 {
    color: #fff;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}
.markdown-body p {
    margin-bottom: 1.5rem;
}
.markdown-body ul, .markdown-body ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}
.markdown-body li {
    margin-bottom: 0.5rem;
}
.markdown-body blockquote {
    border-left: 4px solid var(--primary-color, #3b82f6);
    padding-left: 1.5rem;
    margin-left: 0;
    color: #94a3b8;
    font-style: italic;
    background: rgba(59, 130, 246, 0.05);
    padding: 1rem 1.5rem;
    border-radius: 0 0.5rem 0.5rem 0;
}
.markdown-body code {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.9em;
    color: #38bdf8;
}
</style>
@endsection
