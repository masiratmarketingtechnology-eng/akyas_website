@extends('layouts.app', ['title' => 'Products | High-Performance Packaging Directory'])

@section('content')
@include('partials.page-header', [
    'eyebrow' => 'Industrial Precision',
    'heading' => 'High-Performance Packaging Directory',
    'description' => 'Specialized industrial solutions engineered for global scale. Our diverse catalog of FIBCs, woven sacks, and custom liners provides the structural integrity required for your supply chain.',
])

<section class="section products-section">
    <div class="container products-layout">
        <aside class="filter-panel">
            <form class="filter-panel__search" method="GET" action="{{ route('products.index') }}">
                @if($filter && $filter !== 'all')
                    <input type="hidden" name="filter" value="{{ $filter }}">
                @endif
                <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
                <button type="submit" aria-label="Search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
            <span class="filter-panel__label">Product Type</span>
            <a class="{{ $filter === 'all' ? 'is-active' : '' }}" href="{{ route('products.index') }}">All</a>
            @foreach($categories as $category)
                <a class="{{ $filter === $category->slug ? 'is-active' : '' }}" href="{{ route('products.index', ['filter' => $category->slug]) }}">{{ $category->name }}</a>
            @endforeach
        </aside>

        <div class="products-content">
            <div class="product-grid reveal-stagger">
                @forelse($products as $product)
                    <article class="product-card">
                        <a class="product-card__image" href="{{ route('products.show', $product->slug) }}">
                            @if($product->image_path)
                                <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                            @else
                                <img src="{{ asset('images/product-card.jpg') }}" alt="{{ $product->name }}">
                            @endif
                        </a>
                        <div class="product-card__body">
                            <span class="card-label">{{ $product->category->name ?? '' }}</span>
                            <h2><a href="{{ route('products.show', $product->slug) }}">{{ $product->name }}</a></h2>
                            @if($product->tagline)
                                <p class="product-card__tagline">{{ $product->tagline }}</p>
                            @endif
                            <a class="button button--secondary button--full" href="{{ route('products.show', $product->slug) }}">View Specs <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                        </div>
                    </article>
                @empty
                    <p class="empty-state">No products found.</p>
                @endforelse
            </div>
        </div>
    </div>
</section>

<section class="section section--surface custom-callout-section">
    <div class="container">
        <div class="custom-callout reveal">
            <div>
                <h2>Need a Custom Specification?</h2>
                <p>Our manufacturing facility can adjust dimensions, fabrics, and safety factors to meet your unique logistical requirements. Speak with a technical specialist today for a custom blueprint.</p>
                <a class="button button--primary" href="#" onclick="openQuoteModal(event)">Request Custom Quote <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <img src="{{ asset('images/custom.jpg') }}" alt="Custom jumbo bags ready for dispatch">
        </div>
    </div>
</section>
@endsection
