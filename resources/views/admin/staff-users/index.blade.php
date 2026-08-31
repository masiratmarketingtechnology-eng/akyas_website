@extends('admin.layout')
@section('content')
<div class="page-header page-header--row">
    <div>
        <h1>Staff Users</h1>
        <p>Manage staff accounts for content creation</p>
    </div>
    <a href="{{ route('admin.staff-users.create') }}" class="btn btn--primary">
        <i class="fa-solid fa-plus"></i> Add Staff User
    </a>
</div>

<div class="filter-bar">
    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search by name or email..." value="{{ request('search') }}">
        <button type="submit" class="btn btn--primary">Search</button>
    </form>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Products Added</th>
                <th>Posts Added</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td><strong>{{ $user->name }}</strong></td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge badge--primary">{{ $user->created_products_count }}</span></td>
                    <td><span class="badge badge--primary">{{ $user->created_posts_count }}</span></td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.staff-users.edit', $user->id) }}" class="btn btn--small btn--outline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            @if($user->id !== auth()->id())
                                <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.staff-users.destroy', $user->id) }}', '{{ $user->name }}')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="empty-state">No staff users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $users->withQueryString()->links() }}
</div>
@endsection
