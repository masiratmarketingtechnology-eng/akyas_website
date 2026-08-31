@extends('layouts.app', ['title' => 'Contact | Akyas'])

@section('content')
<section class="section contact-intro">
    <div class="container two-column two-column--align-center">
        <div class="reveal-left">
            <span class="eyebrow">Get In Touch</span>
            <h1>Securing goods.<br>Powering growth.</h1>
            <p class="lead">Whether you're transporting food, chemicals, or construction materials, our bulk packaging solutions are built on strength, reliability, and purpose. Reach out to start your journey with Oman's packaging leader.</p>
        </div>
        <div class="photo-frame photo-frame--contact reveal-right">
            <img src="{{ asset('images/contact-hero.jpg') }}" alt="Jumbo bag on warehouse shelving">
        </div>
    </div>
</section>

<section class="section contact-info-section">
    <div class="container contact-info-grid reveal-stagger">
        <article class="contact-info-card">
            <span class="icon-badge"><i class="fa-solid fa-phone" aria-hidden="true"></i></span>
            <h2>Call Us</h2>
            <a href="tel:+96824591765">+968 24591765</a>
            <a href="tel:+96890140848">+968 90140848</a>
        </article>
        <article class="contact-info-card">
            <span class="icon-badge"><i class="fa-solid fa-envelope" aria-hidden="true"></i></span>
            <h2>Email</h2>
            <a href="mailto:info@omanplas.com">info@omanplas.com</a>
        </article>
        <article class="contact-info-card">
            <span class="icon-badge"><i class="fa-solid fa-location-dot" aria-hidden="true"></i></span>
            <h2>Visit Us</h2>
            <p>Al Hirmal Street, Ghala,<br>Muscat, Oman<br>PO Box 2993, PC 112</p>
        </article>
        <article class="contact-info-card">
            <span class="icon-badge"><i class="fa-solid fa-stopwatch" aria-hidden="true"></i></span>
            <h2>Working Hours</h2>
            <p>Sun - Thu: 8:00 - 17:00<br>Fri - Sat: Closed</p>
        </article>
    </div>
</section>

<section class="section enquiry-section">
    <div class="container enquiry-grid">
        <div class="enquiry-form-wrap reveal-left">
            <span class="eyebrow eyebrow--with-line">Send an Enquiry</span>
            <h2>We'd love to hear from you</h2>
            @if(session('success'))
                <div class="alert alert--success">{{ session('success') }}</div>
            @endif
            @if($errors->any())
                <div class="alert alert--error">{{ $errors->first() }}</div>
            @endif
            <form class="enquiry-form" method="POST" action="{{ route('contact.store') }}">
                @csrf
                <div class="form-row">
                    <label><span class="label-text">Full Name <span class="required">*</span></span><input type="text" name="full_name" value="{{ old('full_name') }}" required></label>
                    <label><span class="label-text">Company Name</span><input type="text" name="company_name" value="{{ old('company_name') }}"></label>
                </div>
                <div class="form-row">
                    <label><span class="label-text">Email <span class="required">*</span></span><input type="email" name="email" value="{{ old('email') }}" required></label>
                    <label><span class="label-text">Phone</span><input type="tel" name="phone" value="{{ old('phone') }}"></label>
                </div>
                <label><span class="label-text">Subject / Product Interest</span>
                    <select name="subject">
                        <option value="">Select a Category</option>
                        <option value="Jumbo Bags">Jumbo Bags</option>
                        <option value="PP Woven Sacks">PP Woven Sacks</option>
                        <option value="Container Liners">Container Liners</option>
                        <option value="Custom Specification">Custom Specification</option>
                    </select>
                </label>
                <label><span class="label-text">Message <span class="required">*</span></span><textarea name="message" rows="6" required>{{ old('message') }}</textarea></label>
                <div class="button-row">
                    <button class="button button--primary" type="submit">Send Enquiry <i class="fa-solid fa-paper-plane" aria-hidden="true"></i></button>
                    @if($siteWhatsapp)
                    <a class="button button--outline" href="https://api.whatsapp.com/send?phone={{ $siteWhatsapp }}" target="_blank" rel="noreferrer">Chat on WhatsApp <i class="fa-brands fa-whatsapp" aria-hidden="true"></i></a>
                    @endif
                </div>
            </form>
        </div>

        <div class="contact-side reveal-right">
            <div class="map-frame">
                <iframe title="Map showing Rusail Industrial Area, Muscat" src="https://www.google.com/maps?q=Rusail+Industrial+Area,+Muscat,+Sultanate+of+Oman&output=embed" loading="lazy"></iframe>
            </div>
            <div class="social-card">
                <div><h3>Connect with Us</h3><p>Follow <strong>@omanplastic</strong> on social media</p></div>
                <div class="social-links">
                    <a href="#" aria-label="Instagram"><i class="fa-brands fa-instagram" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Facebook"><i class="fa-brands fa-facebook-f" aria-hidden="true"></i></a>
                    <a href="#" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in" aria-hidden="true"></i></a>
                    <a href="#" aria-label="Twitter"><i class="fa-brands fa-x-twitter" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
