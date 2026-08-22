@extends('admin.layouts.app')

@section('title', 'Create Blog Post')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.blogs.index') }}">Blog Management</a></li>
    <li class="breadcrumb-item active">Create Post</li>
@endsection

@section('content')
    <div class="mb-4">
        <h1 class="page-title">Create Blog Post</h1>
        <p class="text-muted mb-0">Write a new article for your website users</p>
    </div>

    @if($errors->any())
        <div class="alert alert-danger mb-4">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Post Content</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="title" class="form-label fw-bold">Title <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required placeholder="Enter post title" onkeyup="generateSlug(this.value)">
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label fw-bold">Slug / URL</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted">/blog/</span>
                                <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug') }}" placeholder="auto-generated-slug">
                            </div>
                            <small class="text-muted">Leave blank to auto-generate from title</small>
                        </div>

                        <div class="mb-3">
                            <label for="excerpt" class="form-label fw-bold">Short Excerpt / Summary</label>
                            <textarea class="form-control" id="excerpt" name="excerpt" rows="3" placeholder="Brief overview of the article shown on blog cards...">{{ old('excerpt') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label fw-bold">Full Article Content <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="12" required placeholder="Write your full article here (Markdown and HTML styling supported)...">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold">Publishing Settings</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label for="category" class="form-label fw-bold">Category <span class="text-danger">*</span></label>
                            <select class="form-select" id="category" name="category" required>
                                <option value="tutorials" {{ old('category') === 'tutorials' ? 'selected' : '' }}>Tutorials</option>
                                <option value="updates" {{ old('category') === 'updates' ? 'selected' : '' }}>Updates</option>
                                <option value="tips" {{ old('category') === 'tips' ? 'selected' : '' }}>Tips & Tricks</option>
                                <option value="news" {{ old('category') === 'news' ? 'selected' : '' }}>Industry News</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="reading_time" class="form-label fw-bold">Reading Time</label>
                            <input type="text" class="form-control" id="reading_time" name="reading_time" value="{{ old('reading_time', '5 min read') }}" placeholder="e.g., 5 min read">
                        </div>

                        <div class="mb-3">
                            <label for="image_file" class="form-label fw-bold">Upload Image File</label>
                            <input type="file" class="form-control" id="image_file" name="image_file" accept="image/*">
                            <small class="text-muted">Upload directly from your computer/phone</small>
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label fw-bold">OR Featured Image URL</label>
                            <input type="url" class="form-control" id="image" name="image" value="{{ old('image') }}" placeholder="https://example.com/image.jpg">
                            <small class="text-muted">Or paste direct URL for thumbnail image</small>
                        </div>

                        <hr class="my-4">

                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_featured">Featured Post</label>
                            <div class="form-text">Display in the large hero section at top of blog</div>
                        </div>

                        <div class="form-check form-switch mb-4">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">Active / Published</label>
                            <div class="form-text">Visible to users on website</div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary py-2">
                                <i class="bi bi-check-lg me-2"></i>Publish Post
                            </button>
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-outline-secondary py-2">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function generateSlug(text) {
            const slugInput = document.getElementById('slug');
            if (slugInput.dataset.manual === 'true') return;
            
            const slug = text
                .toString()
                .toLowerCase()
                .trim()
                .replace(/\s+/g, '-')
                .replace(/[^\w\-]+/g, '')
                .replace(/\-\-+/g, '-');
                
            slugInput.value = slug;
        }

        document.getElementById('slug').addEventListener('input', function() {
            this.dataset.manual = 'true';
        });
    </script>
@endsection
