@extends('admin.layout')
@section('content')
<div class="page-header page-header--row">
    <div>
        <h1>Blog Posts</h1>
        <p>Manage your blog content</p>
    </div>
    <a href="{{ route('admin.blog.create') }}" class="btn btn--primary">
        <i class="fa-solid fa-plus"></i> Add Post
    </a>
</div>

<div class="filter-bar">
    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search posts..." value="{{ request('search') }}">
        <select name="category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn--primary">Filter</button>
    </form>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Category</th>
                <th>Added By</th>
                <th>Status</th>
                <th>Published</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}" class="table-image">
                        @else
                            <div class="table-image table-image--placeholder">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $post->title }}</strong></td>
                    <td>{{ $post->category->name ?? '-' }}</td>
                    <td>{{ $post->creator->name ?? '-' }}</td>
                    <td>
                        @if($post->published_at)
                            <span class="badge badge--success">Published</span>
                        @else
                            <span class="badge badge--warning">Draft</span>
                        @endif
                    </td>
                    <td>{{ $post->published_at ? $post->published_at->format('M d, Y') : '-' }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn--small btn--outline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.blog.destroy', $post->id) }}', '{{ $post->title }}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">No blog posts found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $posts->withQueryString()->links() }}
</div>
@endsection
