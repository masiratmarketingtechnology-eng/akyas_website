@extends('layouts.app', ['title' => 'Akyas | Securing Goods. Powering Growth.'])

@section('content')
<section class="home-hero">
    <div class="hero-bg-wrap"><img class="hero-bg-img" src="{{ asset('images/home-hero.jpg') }}" alt="" aria-hidden="true"></div>
    <div class="container hero-inner">
        <div class="hero-copy reveal">
            <h1>Securing Goods.<br>Powering Growth.</h1>
            <p>Specialized packaging solutions engineered for global commerce. From bulk chemicals to agriculture, we protect your products with precision-manufactured Jumbo Bags and PP Woven Sacks.</p>
            <div class="button-row">
                <a class="button button--white" href="{{ route('products.index') }}">View Products <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                <a class="button button--outline-light" href="#" onclick="openQuoteModal(event)">Get a Quote</a>
            </div>
        </div>
    </div>
</section>

<section class="section advantage-section">
    <div class="container">
        <div class="section-intro section-intro--left reveal">
            <span class="eyebrow">The Akyas Advantage</span>
            <h2>Precision Engineered for Performance</h2>
        </div>
        <div class="advantage-grid">
            <div class="photo-frame photo-frame--tall reveal-left">
                <img src="{{ asset('images/advantage-bags.jpg') }}" alt="Akyas jumbo bags stacked in a manufacturing facility">
            </div>
            <div class="advantage-list reveal-stagger">
                <article class="feature-card">
                    <span class="icon-badge"><i class="fa-solid fa-globe" aria-hidden="true"></i></span>
                    <div>
                        <h3>Global Reach</h3>
                        <p>Operating from the Sultanate of Oman, our strategic location allows us to deliver high-quality packaging solutions across six continents with speed and reliability.</p>
                    </div>
                </article>
                <article class="feature-card">
                    <span class="icon-badge"><i class="fa-solid fa-leaf" aria-hidden="true"></i></span>
                    <div>
                        <h3>Eco-Conscious</h3>
                        <p>We are committed to sustainable manufacturing, optimizing material usage and reducing waste in our Oman-based facility.</p>
                    </div>
                </article>
                <article class="feature-card">
                    <span class="icon-badge"><i class="fa-solid fa-shield-halved" aria-hidden="true"></i></span>
                    <div>
                        <h3>Quality First</h3>
                        <p>Our manufacturing processes are certified to meet the highest international standards for safety and tensile strength.</p>
                    </div>
                </article>
            </div>
        </div>
    </div>
</section>

<section class="section section--surface solutions-section">
    <div class="container">
        <div class="section-intro reveal">
            <h2>Core Packaging Solutions</h2>
            <p>Designed to withstand the rigors of heavy industrial transport while maintaining the integrity of your most sensitive materials.</p>
        </div>
        <div class="solution-grid reveal-stagger">
            <article class="solution-card">
                <img src="{{ asset('images/woven-sacks.jpg') }}" alt="PP woven sacks in a clean factory">
                <div class="solution-card__body">
                    <span class="card-label">Woven Series</span>
                    <h3>PP Woven Sacks</h3>
                    <p>Durable, cost-effective packaging for agriculture, flour, sugar, and minerals. Available laminated and non-laminated.</p>
                    <div class="button-row">
                        <a class="button button--secondary button--small" href="{{ route('products.index', ['filter' => 'pp-woven-sacks']) }}">View Products</a>
                        <a class="button button--outline button--small" href="#" onclick="openQuoteModal(event)">Custom Order <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </article>
            <article class="solution-card">
                <img src="{{ asset('images/Jumbo-Bags.jpg') }}" alt="Industrial jumbo bags on a pallet">
                <div class="solution-card__body">
                    <span class="card-label">FIBC Series</span>
                    <h3>Industrial Jumbo Bags</h3>
                    <p>Versatile, heavy-duty bulk containers for safe lifting, filling, transport and discharge of non-dangerous bulk materials.</p>
                    <div class="button-row">
                        <a class="button button--secondary button--small" href="{{ route('products.index', ['filter' => 'jumbo-bags']) }}">View Products</a>
                        <a class="button button--outline button--small" href="#" onclick="openQuoteModal(event)">Custom Order <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<section class="section legacy-section">
    <div class="container">
        <div class="section-intro reveal">
            <h2>A Legacy of Purpose</h2>
        </div>
        <div class="legacy-grid">
            <div class="photo-frame photo-frame--legacy reveal-left">
                <img src="{{ asset('images/legacy.jpg') }}" alt="Camel caravan merging into a modern warehouse of jumbo bags">
            </div>
            <div class="legacy-copy reveal-right">
                <p>For thousands of years, bags have carried more than goods - they've carried journeys, intentions, and trust. From camel caravans on the Silk Road to the warehouses of today, the need to transport with care has remained unchanged.</p>
                <p>At <strong>Akyas</strong>, we draw our name - and our inspiration - from the Arabic word for "bags". Our bulk packaging solutions are built on the same principles that have guided generations: strength, reliability, and purpose.</p>
                <p>But we go further - combining heritage with innovation, and tradition with technology. Whether it's food, chemicals, or construction materials, when your products travel in Akyas bags, they're protected because of our expertise and a vision for a better future.</p>
                <div class="stats-row">
                    <div><strong>99.9%</strong><span>Reliability Rate</span></div>
                    <div><strong>100%</strong><span>Quality Assured</span></div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="section section--surface parent-section">
    <div class="container parent-grid">
        <div class="parent-copy reveal-left">
            <span class="eyebrow">Parent Company</span>
            <h2><span class="text-primary">Oman Plastic Industries LLC</span><br>A Trusted Name in Plastic Manufacturing</h2>
            <p>Oman Plastic Industries LLC (OPI) is a leading manufacturer of flexible packaging and industrial packaging products, based in Muscat, Sultanate of Oman. Established in 1985, we have grown steadily through continuous investment in technology, skilled people, and a relentless focus on quality.</p>
            <a class="button button--primary" href="https://opidev.omanplas.com" target="_blank" rel="noreferrer">Visit Site <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
        </div>
        <div class="photo-frame photo-frame--parent reveal-right">
            <img src="{{ asset('images/parent.jpg') }}" alt="Flexible packaging assortment from Oman Plastic Industries">
        </div>
    </div>
</section>
@endsection
