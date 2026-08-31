@extends('admin.layout')
@section('content')
<div class="page-header page-header--row">
    <div>
        <h1>Blog Categories</h1>
        <p>Manage blog categories</p>
    </div>
    <a href="{{ route('admin.blog-categories.create') }}" class="btn btn--primary">
        <i class="fa-solid fa-plus"></i> Add Category
    </a>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Posts</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>{{ $category->slug }}</td>
                    <td><span class="badge badge--primary">{{ $category->posts_count }}</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.blog-categories.edit', $category->id) }}" class="btn btn--small btn--outline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.blog-categories.destroy', $category->id) }}', '{{ $category->name }}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="empty-state">No categories found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
