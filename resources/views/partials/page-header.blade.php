<section class="page-header">
    <div class="container">
        <span class="eyebrow">{{ $eyebrow }}</span>
        <h1>{{ $heading }}</h1>
        @if(!empty($description))
            <p>{{ $description }}</p>
        @endif
    </div>
</section>
