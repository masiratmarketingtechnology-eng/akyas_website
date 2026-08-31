@extends('layouts.app', ['title' => 'About Akyas | Reliable Packaging Solutions'])

@section('content')
<section class="section identity-section">
    <div class="container two-column two-column--align-center">
        <div class="identity-copy reveal-left">
            <span class="eyebrow">Our Identity</span>
            <h1>Akyas: Pioneering Reliable Packaging Solutions</h1>
            <p>Akyas is a specialized packaging brand focused on delivering dependable and efficient packaging solutions for commercial, industrial, and consumer applications. The brand represents quality, consistency, and innovation in plastic packaging.</p>
            <p>Akyas provides customized solutions designed to meet the needs of different industries, with emphasis on product reliability, cost efficiency, and customer satisfaction.</p>
        </div>
        <div class="photo-frame photo-frame--identity reveal-right">
            <img src="{{ asset('images/about-workers.jpg') }}" alt="Two factory workers lifting an Akyas jumbo bag">
        </div>
    </div>
</section>

<section class="section section--surface mission-section">
    <div class="container split-cards reveal-stagger">
        <article class="mission-card">
            <span class="icon-badge"><i class="fa-solid fa-rocket" aria-hidden="true"></i></span>
            <h2>Mission</h2>
            <blockquote>"Our mission is to manufacture and deliver high-quality plastic packaging solutions through advanced technology, skilled people, and continuous innovation while maintaining the highest standards of quality, safety, and customer service."</blockquote>
            <p>Building long-term partnerships by understanding needs and providing reliable value.</p>
        </article>
        <article class="mission-card mission-card--dark">
            <span class="icon-badge icon-badge--light"><i class="fa-solid fa-eye" aria-hidden="true"></i></span>
            <h2>Vision</h2>
            <blockquote>"To become a recognized regional and international leader in the plastic packaging industry by delivering innovative, sustainable, and world-class packaging solutions while contributing to industrial growth and environmental responsibility."</blockquote>
            <span class="mission-card__label"><i class="fa-solid fa-minus" aria-hidden="true"></i> GLOBAL SCALE</span>
        </article>
    </div>
</section>

<section class="section capabilities-section">
    <div class="container">
        <div class="section-heading-row reveal">
            <div>
                <span class="eyebrow">Infrastructure</span>
                <h2>Manufacturing Capabilities</h2>
                <p>Our facilities utilize high-precision engineering and automated processes to ensure the consistency of every product we deliver.</p>
            </div>
            <div class="stat-chips">
                <span><strong>100%</strong> QUALITY</span>
                <span><strong>ISO</strong> CERTIFIED</span>
            </div>
        </div>
        <div class="capability-grid reveal-stagger">
            <article class="capability-card">
                <img src="{{ asset('images/pp-tape.jpg') }}" alt="PP tape production machinery">
                <div><h3>PP Tape Production</h3><p>High-speed extrusion and precision drawing for superior tensile strength and tape consistency.</p></div>
            </article>
            <article class="capability-card">
                <img src="{{ asset('images/circular.jpg') }}" alt="Circular weaving production line">
                <div><h3>Circular Weaving</h3><p>Advanced circular looms producing seamless, heavy-duty woven fabric for diverse industrial loads.</p></div>
            </article>
            <article class="capability-card">
                <img src="{{ asset('images/bag.jpg') }}" alt="Bag conversion and stitching line">
                <div><h3>Bag Conversion</h3><p>Automated stitching and finishing lines ensuring structural integrity and precise dimensions.</p></div>
            </article>
        </div>
    </div>
</section>

<section class="section section--surface values-section">
    <div class="container">
        <div class="section-intro section-intro--left reveal">
            <span class="eyebrow">Ethical Foundation</span>
            <h2>Our Core Values</h2>
        </div>
        <div class="values-grid reveal-stagger">
            @foreach([
                ['icon' => 'fa-star', 'title' => 'Quality', 'text' => 'Uncompromising standards in every product that leaves our facility.'],
                ['icon' => 'fa-lightbulb', 'title' => 'Innovation', 'text' => 'Continuously evolving our processes and products for the modern world.'],
                ['icon' => 'fa-gem', 'title' => 'Integrity', 'text' => 'Building trust through transparent operations and honest partnerships.'],
                ['icon' => 'fa-shield-halved', 'title' => 'Safety', 'text' => 'Prioritizing the wellbeing of our people and the security of your goods.'],
                ['icon' => 'fa-leaf', 'title' => 'Sustainability', 'text' => 'Committed to environmental responsibility and circular economy practices.'],
                ['icon' => 'fa-handshake', 'title' => 'Commitment', 'text' => 'Dedicated to exceeding customer expectations at every touchpoint.'],
            ] as $value)
                <article class="value-card">
                    <span class="value-icon"><i class="fa-solid {{ $value['icon'] }}" aria-hidden="true"></i></span>
                    <h3>{{ $value['title'] }}</h3>
                    <p>{{ $value['text'] }}</p>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="image-banner" style="background-image: linear-gradient(90deg, rgba(13,181,172,.93), rgba(52,51,153,.32)), url('{{ asset('images/ctabanner.jpg') }}');">
    <div class="container image-banner__inner reveal">
        <h2>World-Class Packaging Excellence</h2>
        <p>Oman Plastic Industries LLC represents the pinnacle of plastic manufacturing in the region, bringing Akyas to the global stage.</p>
        <a class="button button--white" href="{{ route('products.index') }}">Explore Our Products <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    </div>
</section>

<section class="section corporate-section">
    <div class="container info-grid reveal-stagger">
        <article>
            <h2>Corporate Information</h2>
            <dl class="detail-list">
                <div><dt>Company Name</dt><dd>Oman Plastic Industries LLC</dd></div>
                <div><dt>Brand</dt><dd>Akyas</dd></div>
                <div><dt>Industry</dt><dd>Plastic Manufacturing &amp; Flexible Packaging Solutions</dd></div>
            </dl>
        </article>
        <article>
            <h2>Main Products</h2>
            <ul class="check-list check-list--compact">
                <li>Flexible Intermediate Bulk Containers (FIBC / Jumbo Bags)</li>
                <li>Woven Polypropylene (PP) Bags</li>
                <li>Industrial Packaging Solutions</li>
                <li>Customized and standard Plastic Packaging Products</li>
                <li>Thermoforming</li>
            </ul>
        </article>
        <article>
            <h2>Manufacturing Scope</h2>
            <ul class="scope-list">
                <li>Polypropylene tape production</li>
                <li>Circular weaving</li>
                <li>Bag conversion and stitching</li>
            </ul>
        </article>
    </div>
</section>
@endsection
