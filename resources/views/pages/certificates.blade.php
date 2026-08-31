@extends('layouts.app', ['title' => 'Certificates | Certified Excellence'])

@section('content')
<section class="section standards-intro">
    <div class="container two-column two-column--align-center">
        <div class="reveal-left">
            <span class="eyebrow">Global Standards</span>
            <h1>Uncompromising Quality, Certified Excellence.</h1>
            <p class="lead">At Akyas, our manufacturing processes are governed by stringent international benchmarks. From food-grade safety to industrial-strength durability, our certifications are a testament to our commitment to global reliability.</p>
        </div>
        <div class="photo-frame photo-frame--standards reveal-right">
            <img src="{{ asset('images/certificate.jpg') }}" alt="Jumbo bags being filled at a factory hopper">
        </div>
    </div>
</section>

<section class="section section--surface certificates-section">
    <div class="container">
        <div class="section-heading-row reveal">
            <div>
                <span class="eyebrow">Documentation</span>
                <h2>Product Certifications</h2>
            </div>
        </div>
        <div class="certificate-grid reveal-stagger">
            @forelse($certificates as $certificate)
                <article class="certificate-card">
                    <div class="certificate-card__image">
                        @if($certificate->thumbnail_path)
                            <img src="{{ asset('storage/' . $certificate->thumbnail_path) }}" alt="{{ $certificate->title }}">
                        @else
                            <img src="{{ asset('images/certificate-hero.jpg') }}" alt="{{ $certificate->title }}">
                        @endif
                        <span class="certificate-stamp">AKYAS<br><strong>QUALITY</strong><br>CERTIFICATE</span>
                    </div>
                    <div class="certificate-card__body">
                        <p><strong>{{ $certificate->title }}</strong></p>
                        @if($certificate->tagline)
                            <p style="font-size:13px;color:#666;">{{ $certificate->tagline }}</p>
                        @endif
                        @if($certificate->file_type === 'pdf')
                            <a class="button button--outline-secondary button--full button--small" href="{{ route('certificates.view', $certificate->id) }}" target="_blank" aria-label="View {{ $certificate->title }}">View PDF</a>
                        @else
                            <a class="button button--outline-secondary button--full button--small" href="{{ route('certificates.view', $certificate->id) }}" target="_blank" aria-label="View {{ $certificate->title }}">View</a>
                        @endif
                    </div>
                </article>
            @empty
                <p class="empty-state">No certificates found.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="cta-band">
    <div class="container cta-band__inner reveal">
        <h2>Need Specific Technical Data?</h2>
        <p>Our engineering team can provide detailed test reports and compliance certificates tailored to your industry requirements.</p>
        <a class="button button--white" href="#" onclick="openQuoteModal(event)">Contact Our Team <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
    </div>
</section>
@endsection
