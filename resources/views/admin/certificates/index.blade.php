@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Certificates</h1>
    <a href="{{ route('admin.certificates.create') }}" class="btn btn--primary">Add Certificate</a>
</div>

<form method="GET" class="search-bar">
    <input type="text" name="search" placeholder="Search certificates..." value="{{ request('search') }}">
    <button type="submit" class="btn btn--primary">Search</button>
</form>

<div class="cert-list">
    @forelse($certificates as $certificate)
        <div class="cert-card">
            <div class="cert-card__thumb">
                @if($certificate->thumbnail_path)
                    <img src="{{ asset('storage/' . $certificate->thumbnail_path) }}" alt="{{ $certificate->title }}">
                @elseif($certificate->file_type !== 'pdf')
                    <img src="{{ asset('storage/' . $certificate->file_path) }}" alt="{{ $certificate->title }}">
                @else
                    <div class="cert-card__placeholder">
                        <i class="fa-solid fa-file-pdf"></i>
                    </div>
                @endif
            </div>
            <div class="cert-card__info">
                <h3>{{ $certificate->title }}</h3>
                @if($certificate->tagline)
                    <p>{{ $certificate->tagline }}</p>
                @endif
                <div class="cert-card__meta">
                    <span class="badge badge--info">{{ strtoupper($certificate->file_type) }}</span>
                    <span>Order: {{ $certificate->sort_order }}</span>
                    <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank">
                        @if($certificate->file_type === 'pdf') View PDF @else View Image @endif
                    </a>
                </div>
            </div>
            <div class="cert-card__actions">
                <a href="{{ route('admin.certificates.edit', $certificate->id) }}" class="btn btn--small btn--outline">Edit</a>
                <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.certificates.destroy', $certificate->id) }}', '{{ $certificate->title }}')">Delete</button>
            </div>
        </div>
    @empty
        <p class="empty-state">No certificates found.</p>
    @endforelse
</div>

{{ $certificates->withQueryString()->links() }}
@endsection
