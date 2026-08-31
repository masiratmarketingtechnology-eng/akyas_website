@extends('admin.layout')
@section('content')
<div class="page-header page-header--row">
    <div>
        <h1>Enquiry Details</h1>
        <p>From {{ $enquiry->full_name }}</p>
    </div>
    <a href="{{ route('admin.enquiries.index') }}" class="btn btn--outline">
        <i class="fa-solid fa-arrow-left"></i> Back to List
    </a>
</div>

<div class="detail-grid">
    <div class="detail-card">
        <h2>Contact Information</h2>
        <div class="detail-list">
            <div class="detail-item">
                <label>Full Name</label>
                <span>{{ $enquiry->full_name }}</span>
            </div>
            <div class="detail-item">
                <label>Email</label>
                <span><a href="mailto:{{ $enquiry->email }}">{{ $enquiry->email }}</a></span>
            </div>
            <div class="detail-item">
                <label>Phone</label>
                <span>{{ $enquiry->phone ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <label>Company</label>
                <span>{{ $enquiry->company_name ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <label>Subject</label>
                <span>{{ $enquiry->subject ?? '-' }}</span>
            </div>
            <div class="detail-item">
                <label>Submitted</label>
                <span>{{ $enquiry->created_at->format('M d, Y h:i A') }}</span>
            </div>
        </div>
    </div>

    <div class="detail-card">
        <h2>Message</h2>
        <div class="detail-message">
            {!! nl2br(e($enquiry->message)) !!}
        </div>
    </div>
</div>

<div class="form-actions">
    <button type="button" class="btn btn--danger" onclick="openDeleteModal('{{ route('admin.enquiries.destroy', $enquiry->id) }}', 'enquiry from {{ $enquiry->full_name }}')">
        <i class="fa-solid fa-trash"></i> Delete Enquiry
    </button>
</div>
@endsection
