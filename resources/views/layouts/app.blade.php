<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="@yield('meta_description', 'Akyas industrial packaging solutions from Oman Plastic Industries LLC.')">
    <title>{{ $title ?? 'Akyas | Industrial Packaging Solutions' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}?v={{ filemtime(public_path('css/app.css')) }}">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}?v={{ filemtime(public_path('css/animations.css')) }}">
</head>
<body>
    @include('partials.header')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')
    @include('partials.quote-modal')

    @if($siteWhatsapp)
    <a href="https://api.whatsapp.com/send?phone={{ $siteWhatsapp }}&text=Hi%2C%20I%27m%20interested%20in%20your%20packaging%20solutions." class="whatsapp-float" target="_blank" rel="noreferrer" aria-label="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>
    @endif

    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/scroll-reveal.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
