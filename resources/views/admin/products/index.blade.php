@extends('admin.layout')
@section('content')
<div class="page-header page-header--row">
    <div>
        <h1>Products</h1>
        <p>Manage your product catalog</p>
    </div>
    <a href="{{ route('admin.products.create') }}" class="btn btn--primary">
        <i class="fa-solid fa-plus"></i> Add Product
    </a>
</div>

<div class="filter-bar">
    <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
        <select name="category">
            <option value="">All Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn btn--primary">Filter</button>
    </form>
</div>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Added By</th>
                <th>Featured</th>
                <th>Created</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $product)
                <tr>
                    <td>
                        @if($product->image_path)
                            <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}" class="table-image">
                        @else
                            <div class="table-image table-image--placeholder">
                                <i class="fa-solid fa-image"></i>
                            </div>
                        @endif
                    </td>
                    <td><strong>{{ $product->name }}</strong></td>
                    <td>{{ $product->category->name ?? '-' }}</td>
                    <td>{{ $product->creator->name ?? '-' }}</td>
                    <td>
                        @if($product->is_featured)
                            <span class="badge badge--success">Featured</span>
                        @else
                            <span class="badge badge--secondary">Normal</span>
                        @endif
                    </td>
                    <td>{{ $product->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="action-buttons">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn--small btn--outline">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.products.destroy', $product->id) }}', '{{ $product->name }}')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="empty-state">No products found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="pagination-wrap">
    {{ $products->withQueryString()->links() }}
</div>
@endsection
