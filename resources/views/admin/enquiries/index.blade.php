@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Enquiries</h1>
    <p>Manage contact form submissions</p>
</div>

<div class="filter-bar">
    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}">
        <select name="status">
            <option value="">All Status</option>
            <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Unread</option>
            <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Read</option>
        </select>
        <button type="submit" class="btn btn--primary">Filter</button>
    </form>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Email</th>
                <th>Company</th>
                <th>Subject</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($enquiries as $enquiry)
                <tr class="{{ is_null($enquiry->read_at) ? 'row--unread' : '' }}">
                    <td>
                        @if(is_null($enquiry->read_at))
                            <span class="badge badge--primary">New</span>
                        @else
                            <span class="badge badge--secondary">Read</span>
                        @endif
                    </td>
                    <td><strong>{{ $enquiry->full_name }}</strong></td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->company_name ?? '-' }}</td>
                    <td>{{ $enquiry->subject ?? '-' }}</td>
                    <td>{{ $enquiry->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.enquiries.show', $enquiry->id) }}" class="btn btn--small btn--outline">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                            <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.enquiries.destroy', $enquiry->id) }}', 'enquiry from {{ $enquiry->full_name }}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">No enquiries found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $enquiries->withQueryString()->links() }}
</div>
@endsection
