@extends('admin.layout')
@section('content')
<div class="page-header page-header--row">
    <div>
        <h1>Product Categories</h1>
        <p>Manage product categories</p>
    </div>
    <a href="{{ route('admin.product-categories.create') }}" class="btn btn--primary">
        <i class="fa-solid fa-plus"></i> Add Category
    </a>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Slug</th>
                <th>Products</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td><strong>{{ $category->name }}</strong></td>
                    <td>{{ $category->slug }}</td>
                    <td><span class="badge badge--primary">{{ $category->products_count }}</span></td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.product-categories.edit', $category->id) }}" class="btn btn--small btn--outline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.product-categories.destroy', $category->id) }}', '{{ $category->name }}')">
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
