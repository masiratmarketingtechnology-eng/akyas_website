@extends('layouts.app', ['title' => 'Blog | Insights for the Industrial Frontier'])

@section('content')
@include('partials.page-header', [
    'eyebrow' => 'Our Journal',
    'heading' => 'Insights for the Industrial Frontier',
    'description' => 'Exploring the intersection of manufacturing precision, global logistics innovation, and sustainable packaging solutions from our Oman-based headquarters.',
])

<section class="section blog-section">
    <div class="container">
        <div class="filter-tabs" role="tablist" aria-label="Blog categories">
            <a class="{{ $filter === 'all' ? 'is-active' : '' }}" href="{{ route('blog.index') }}">All Stories</a>
            @foreach($categories as $category)
                <a class="{{ $filter === $category->slug ? 'is-active' : '' }}" href="{{ route('blog.index', ['filter' => $category->slug]) }}">{{ $category->name }}</a>
            @endforeach
        </div>

        @if($featuredPost)
            <article class="featured-post reveal">
                <a class="featured-post__image" href="{{ route('blog.show', $featuredPost->slug) }}">
                    @if($featuredPost->image_path)
                        <img src="{{ asset('storage/' . $featuredPost->image_path) }}" alt="{{ $featuredPost->title }}">
                    @else
                        <img src="{{ asset('images/blog-featured.jpg') }}" alt="{{ $featuredPost->title }}">
                    @endif
                </a>
                <div class="featured-post__body">
                    <div class="post-meta">
                        <span>{{ $featuredPost->published_at?->format('M d, Y') ?? 'Draft' }}</span>
                        <span>{{ $featuredPost->read_time_minutes }} min read</span>
                    </div>
                    <span class="card-label">{{ $featuredPost->category->name ?? '' }}</span>
                    <h2><a href="{{ route('blog.show', $featuredPost->slug) }}">{{ $featuredPost->title }}</a></h2>
                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($featuredPost->content), 120) }}</p>
                    <a class="text-link" href="{{ route('blog.show', $featuredPost->slug) }}">Read Analysis <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>
        @endif

        <div class="blog-grid reveal-stagger">
            @forelse($posts as $post)
                <article class="blog-card">
                    <a class="blog-card__image" href="{{ route('blog.show', $post->slug) }}">
                        @if($post->image_path)
                            <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('images/blog-featured.jpg') }}" alt="{{ $post->title }}">
                        @endif
                        <span class="post-tag">{{ $post->category->name ?? '' }}</span>
                    </a>
                    <div class="blog-card__body">
                        <div class="post-meta">
                            <span>{{ $post->published_at?->format('M d, Y') ?? 'Draft' }}</span>
                            <span>{{ $post->read_time_minutes }} min read</span>
                        </div>
                        <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 120) }}</p>
                        <a class="text-link" href="{{ route('blog.show', $post->slug) }}">Read More <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </article>
            @empty
                <p class="empty-state">No blog posts found.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
