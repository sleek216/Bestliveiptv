@extends('admin.layouts.app')

@section('title', 'Blog Management')

@section('breadcrumb')
    <li class="breadcrumb-item active">Blog Management</li>
@endsection

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="page-title">Blog Management</h1>
            <p class="text-muted mb-0">Manage news, tutorials, updates, and tips for your users</p>
        </div>
        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Create Post
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            @if($blogs->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4">Title</th>
                                <th>Category</th>
                                <th>Reading Time</th>
                                <th>Featured</th>
                                <th>Status</th>
                                <th>Published Date</th>
                                <th class="text-end pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($blogs as $blog)
                                <tr>
                                    <td class="ps-4">
                                        <div class="d-flex align-items-center gap-3">
                                            @if($blog->image)
                                                <img src="{{ $blog->image }}" alt="" class="rounded" style="width: 45px; height: 45px; object-fit: cover;">
                                            @else
                                                <div class="bg-light rounded d-flex align-items-center justify-content-center text-secondary" style="width: 45px; height: 45px;">
                                                    <i class="bi bi-newspaper fs-5"></i>
                                                </div>
                                            @endif
                                            <div>
                                                <strong class="text-dark d-block">{{ Str::limit($blog->title, 50) }}</strong>
                                                <small class="text-muted">/blog/{{ $blog->slug }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if($blog->category === 'tutorials')
                                            <span class="badge bg-primary">Tutorials</span>
                                        @elseif($blog->category === 'updates')
                                            <span class="badge bg-info text-dark">Updates</span>
                                        @elseif($blog->category === 'tips')
                                            <span class="badge bg-warning text-dark">Tips & Tricks</span>
                                        @else
                                            <span class="badge bg-secondary">Industry News</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="text-muted"><i class="bi bi-clock me-1"></i>{{ $blog->reading_time }}</span>
                                    </td>
                                    <td>
                                        @if($blog->is_featured)
                                            <span class="badge bg-warning text-dark"><i class="bi bi-star-fill me-1"></i>Featured</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($blog->is_active)
                                            <span class="badge bg-success">Active</span>
                                        @else
                                            <span class="badge bg-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href="{{ route('admin.blogs.edit', $blog) }}" class="btn btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.blogs.toggle-active', $blog) }}" method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-secondary" title="Toggle Status">
                                                    <i class="bi bi-toggle-{{ $blog->is_active ? 'on' : 'off' }}"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.blogs.destroy', $blog) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="p-4 border-top">
                    {{ $blogs->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <i class="bi bi-journal-x display-4 text-muted mb-3"></i>
                    <h5>No Blog Posts Found</h5>
                    <p class="text-muted">Get started by creating your first blog article!</p>
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary mt-2">
                        <i class="bi bi-plus-lg me-2"></i>Create First Post
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
