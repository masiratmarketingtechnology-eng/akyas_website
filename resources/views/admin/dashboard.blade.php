@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Dashboard</h1>
    <p>Welcome back, {{ auth()->user()->name }}</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--primary">
            <i class="fa-solid fa-box"></i>
        </div>
        <div class="stat-card__content">
            <span class="stat-card__value">{{ $stats['products'] }}</span>
            <span class="stat-card__label">Products</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--secondary">
            <i class="fa-solid fa-newspaper"></i>
        </div>
        <div class="stat-card__content">
            <span class="stat-card__value">{{ $stats['blog_posts'] }}</span>
            <span class="stat-card__label">Blog Posts</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--success">
            <i class="fa-solid fa-envelope"></i>
        </div>
        <div class="stat-card__content">
            <span class="stat-card__value">{{ $stats['enquiries'] }}</span>
            <span class="stat-card__label">Total Enquiries</span>
        </div>
    </div>
    <div class="stat-card">
        <div class="stat-card__icon stat-card__icon--warning">
            <i class="fa-solid fa-envelope-circle-exclamation"></i>
        </div>
        <div class="stat-card__content">
            <span class="stat-card__value">{{ $stats['unread_enquiries'] }}</span>
            <span class="stat-card__label">Unread Enquiries</span>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="dashboard-card__header">
            <h2>Recent Products</h2>
            <a href="{{ route('admin.products.index') }}">View All</a>
        </div>
        <div class="dashboard-card__body">
            @forelse($recentProducts as $product)
                <div class="list-item">
                    <div class="list-item__content">
                        <strong>{{ $product->name }}</strong>
                        <span>{{ $product->category->name ?? 'Uncategorized' }}</span>
                        <small>{{ $product->created_at->diffForHumans() }}</small>
                    </div>
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn--small">Edit</a>
                </div>
            @empty
                <p class="empty-state">No products yet.</p>
            @endforelse
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-card__header">
            <h2>Recent Enquiries</h2>
            <a href="{{ route('admin.enquiries.index') }}">View All</a>
        </div>
        <div class="dashboard-card__body">
            @forelse($recentEnquiries as $enquiry)
                <div class="list-item {{ is_null($enquiry->read_at) ? 'list-item--unread' : '' }}">
                    <div class="list-item__content">
                        <strong>{{ $enquiry->full_name }}</strong>
                        <span>{{ $enquiry->email }}</span>
                        <small>{{ $enquiry->created_at->diffForHumans() }}</small>
                    </div>
                    <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="btn btn--small">View</a>
                </div>
            @empty
                <p class="empty-state">No enquiries yet.</p>
            @endforelse
        </div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-card__header">
            <h2>Recent Blog Posts</h2>
            <a href="{{ route('admin.blog.index') }}">View All</a>
        </div>
        <div class="dashboard-card__body">
            @forelse($recentPosts as $post)
                <div class="list-item">
                    <div class="list-item__content">
                        <strong>{{ $post->title }}</strong>
                        <span>{{ $post->category->name ?? 'Uncategorized' }}</span>
                        <small>{{ $post->created_at->diffForHumans() }}</small>
                    </div>
                    <a href="{{ route('admin.blog.edit', $post->id) }}" class="btn btn--small">Edit</a>
                </div>
            @empty
                <p class="empty-state">No blog posts yet.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
