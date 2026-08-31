@extends('layouts.app', ['title' => $product->name . ' | Akyas'])

@section('content')
<section class="section product-detail-section">
    <div class="container">
        <nav class="breadcrumbs" aria-label="Breadcrumb">
            <a href="{{ route('products.index') }}">Products</a>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            <span>{{ $product->category->name ?? '' }}</span>
            <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
            <strong>{{ $product->name }}</strong>
        </nav>

        <div class="product-detail-grid">
            <div class="product-gallery">
                <div class="product-gallery__main">
                    @if($product->image_path)
                        <img id="product-main-image" src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    @else
                        <img id="product-main-image" src="{{ asset('images/product-card.jpg') }}" alt="{{ $product->name }}">
                    @endif
                </div>
                @if($product->images->count())
                    <div class="product-gallery__thumbs">
                        <button class="is-active" type="button" data-product-image="{{ $product->image_path ? asset('storage/' . $product->image_path) : asset('images/product-card.jpg') }}" aria-label="Main image">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="">
                            @else
                                <img src="{{ asset('images/product-card.jpg') }}" alt="">
                            @endif
                        </button>
                        @foreach($product->images as $image)
                            <button type="button" data-product-image="{{ asset('storage/' . $image->path) }}" aria-label="Product image {{ $loop->iteration + 1 }}">
                                <img src="{{ asset('storage/' . $image->path) }}" alt="">
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="product-detail-copy">
                <span class="eyebrow">{{ $product->tagline }}</span>
                <h1>{{ $product->name }}</h1>
                <div class="rule"></div>

                @if($product->specs && count($product->specs) > 0)
                    <div class="feature-list">
                        @foreach($product->specs as $label => $value)
                            <div class="feature-row">
                                <span class="check-icon"><i class="fa-solid fa-check" aria-hidden="true"></i></span>
                                <div><strong>{{ $label }}</strong><p>{{ $value }}</p></div>
                            </div>
                        @endforeach
                    </div>
                @endif

                <div class="button-row">
                    <a class="button button--primary" href="#" onclick="openQuoteModal(event)">Request Quote <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    @if($siteWhatsapp)
                    <a class="button button--outline-secondary" href="https://api.whatsapp.com/send?phone={{ $siteWhatsapp }}&text=Hi%2C%20I%27m%20interested%20in%20{{ urlencode($product->name) }}.%20Please%20share%20the%20details." target="_blank" rel="noreferrer">Enquire on WhatsApp <i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="product-description">
            <h2>Description</h2>
            <div class="rule"></div>
            <p>{{ $product->description }}</p>
        </div>
    </div>
</section>

@section('scripts')
<script>
    document.querySelectorAll('.product-gallery__thumbs button').forEach(btn => {
        btn.addEventListener('click', function() {
            const mainImage = document.getElementById('product-main-image');
            mainImage.src = this.dataset.productImage;
            document.querySelectorAll('.product-gallery__thumbs button').forEach(b => b.classList.remove('is-active'));
            this.classList.add('is-active');
        });
    });
</script>
@endsection

<section class="section section--surface related-section">
    <div class="container">
        <div class="section-intro section-intro--left">
            <span class="eyebrow">Explore More</span>
            <h2>Related Products</h2>
        </div>
        <div class="related-grid">
            @forelse($relatedProducts as $related)
                <article class="related-card">
                    <a class="related-card__image" href="{{ route('products.show', $related->slug) }}">
                        @if($related->image_path)
                            <img src="{{ asset('storage/' . $related->image_path) }}" alt="{{ $related->name }}">
                        @else
                            <img src="{{ asset('images/product-card.jpg') }}" alt="{{ $related->name }}">
                        @endif
                    </a>
                    <div class="related-card__body">
                        <span class="card-label">{{ $related->category->name ?? '' }}</span>
                        <h3><a href="{{ route('products.show', $related->slug) }}">{{ $related->name }}</a></h3>
                        <div class="related-card__meta">
                            <span>{{ $related->tagline }}</span>
                            <a href="{{ route('products.show', $related->slug) }}" aria-label="View {{ $related->name }}"><i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </article>
            @empty
                <p>No related products found.</p>
            @endforelse
        </div>
    </div>
</section>
@endsection
