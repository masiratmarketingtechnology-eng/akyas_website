<header class="site-header">
    <div class="container header-inner">
        <a class="brand" href="{{ route('home') }}" aria-label="Akyas home">
            <img class="brand-mark" src="{{ asset('images/logo.png') }}" alt="Akyas Logo" width="60" height="60">
        </a>

        <nav class="main-nav" id="main-nav" aria-label="Primary navigation">
            <a class="{{ request()->routeIs('home') ? 'is-active' : '' }}" href="{{ route('home') }}">Home</a>
            <a class="{{ request()->routeIs('about') ? 'is-active' : '' }}" href="{{ route('about') }}">About</a>
            <a class="{{ request()->routeIs('products.*') ? 'is-active' : '' }}" href="{{ route('products.index') }}">Products</a>
            <a class="{{ request()->routeIs('certificates') ? 'is-active' : '' }}" href="{{ route('certificates') }}">Certificates</a>
            <a class="{{ request()->routeIs('blog.*') ? 'is-active' : '' }}" href="{{ route('blog.index') }}">Blog</a>
            <a class="{{ request()->routeIs('contact') ? 'is-active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </nav>

        <a class="button button--primary header-cta" href="#" onclick="openQuoteModal(event)">Get Quote <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
        <button class="menu-toggle" type="button" aria-label="Toggle navigation" aria-controls="main-nav" aria-expanded="false">
            <i class="fa-solid fa-bars" aria-hidden="true"></i>
        </button>
    </div>
</header>
