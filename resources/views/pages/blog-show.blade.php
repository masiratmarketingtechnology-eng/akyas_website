@extends('layouts.app', ['title' => ($post->meta_title ?: $post->title) . ' | Akyas Journal'])

@section('meta_description', $post->meta_description ?: strip_tags(Str::limit($post->content, 155)))

@section('content')
<section class="article-intro">
    <div class="container article-intro__inner">
        <span class="post-tag post-tag--soft">{{ $post->category->name ?? '' }}</span>
        <h1>{{ $post->title }}</h1>
        <div class="post-meta post-meta--center">
            <span><i class="fa-regular fa-calendar" aria-hidden="true"></i> {{ $post->published_at?->format('M d, Y') ?? 'Draft' }}</span>
            <span><i class="fa-regular fa-clock" aria-hidden="true"></i> {{ $post->read_time_minutes }} min read</span>
        </div>
    </div>
</section>

<section class="article-section">
    <div class="container article-container">
        @if($post->image_path)
            <img class="article-hero" src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
        @else
            <img class="article-hero" src="{{ asset('images/blog-hero.jpg') }}" alt="{{ $post->title }}">
        @endif

        <article class="article-body">
            <section>
                {!! $post->content !!}
            </section>

            <div class="article-share">
                <div class="share-links">
                    <span>Share:</span>
                    <a href="#" aria-label="Share on Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Share on LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Share on Twitter"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                </div>
                <a class="text-link" href="{{ route('blog.index') }}"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Back to Articles</a>
            </div>
        </article>

        <section class="related-articles">
            <div class="section-intro section-intro--left">
                <h2>Related Articles</h2>
            </div>
            <div class="blog-grid blog-grid--related">
                @forelse($relatedPosts as $related)
                    <article class="blog-card">
                        <a class="blog-card__image" href="{{ route('blog.show', $related->slug) }}">
                            @if($related->image_path)
                                <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->title }}">
                            @else
                                <img src="{{ asset('images/blog-featured.jpg') }}" alt="{{ $related->title }}">
                            @endif
                            <span class="post-tag">{{ $related->category->name ?? '' }}</span>
                        </a>
                        <div class="blog-card__body">
                            <h2><a href="{{ route('blog.show', $related->slug) }}">{{ $related->title }}</a></h2>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($related->content), 100) }}</p>
                            <a class="text-link" href="{{ route('blog.show', $related->slug) }}">Read More <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </article>
                @empty
                    <p>No related articles found.</p>
                @endforelse
            </div>
        </section>
    </div>
</section>
@endsection
