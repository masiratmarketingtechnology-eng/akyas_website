<footer class="site-footer">
    <div class="container footer-grid">
        <div class="footer-brand">
            <a class="brand brand--footer" href="{{ route('home') }}" aria-label="Akyas home">
                <img class="brand-mark" src="{{ asset('images/logo-white.png') }}" alt="Akyas Logo" width="60" height="60">
            </a>
            <p>Setting the global benchmark in industrial packaging through the lens of Omani craftsmanship and technical excellence.</p>
        </div>

        <div class="footer-column">
            <h3>Products</h3>
            <a href="{{ route('products.index', ['filter' => 'jumbo-bags']) }}">Jumbo Bags</a>
            <a href="{{ route('products.index', ['filter' => 'pp-woven-sacks']) }}">PP Woven Sacks</a>
            <a href="{{ route('contact') }}">Custom Sizing</a>
            <a href="{{ route('certificates') }}">Safety Certifications</a>
        </div>
        <div class="footer-column">
            <h3>Company</h3>
            <a href="{{ route('about') }}">About Us</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('certificates') }}">Certification</a>
            <a href="{{ route('blog.index') }}">Blog</a>
        </div>
        <div class="footer-column footer-column--contact">
            <h3>Contact</h3>
            <p><i class="fa-solid fa-location-dot" aria-hidden="true"></i> Rusail Industrial Area, Muscat, Sultanate of Oman</p>
            <a href="tel:+96898550921"><i class="fa-solid fa-phone" aria-hidden="true"></i> +968 98550921</a>
            <a href="mailto:marketing@omanplas.com"><i class="fa-solid fa-envelope" aria-hidden="true"></i> marketing@omanplas.com</a>
        </div>
    </div>
    <div class="container footer-bottom">
        <span>© 2026 Akyas | Oman Plastic Industries LLC. All Rights Reserved.</span>
        <span>Developed By Masirat Technologies</span>
    </div>
</footer>
