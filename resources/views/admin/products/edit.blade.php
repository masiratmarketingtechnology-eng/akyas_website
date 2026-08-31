@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Edit Product</h1>
    <p>Update {{ $product->name }}</p>
</div>

<form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data" class="admin-form" data-disable-on-submit>
    @csrf
    @method('PUT')
    <div class="form-grid">
        <div class="form-card">
            <h2>Basic Info</h2>
            <div class="form-group">
                <label for="name">Product Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', $product->name) }}" class="form-input @error('name') is-error @enderror" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="category_id">Category <span class="required">*</span></label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') is-error @enderror" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="tagline">Tagline</label>
                <input type="text" id="tagline" name="tagline" value="{{ old('tagline', $product->tagline) }}" class="form-input @error('tagline') is-error @enderror">
                @error('tagline')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="description">Description <span class="required">*</span></label>
                <textarea id="description" name="description" rows="5" class="form-textarea @error('description') is-error @enderror" required>{{ old('description', $product->description) }}</textarea>
                @error('description')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-card">
            <h2>Specifications</h2>
            <div class="form-group">
                <label for="specs">Specifications (Key: Value per line)</label>
                <textarea id="specs" name="specs" rows="6" class="form-textarea">{{ old('specs', is_array($product->specs) ? collect($product->specs)->map(fn($v, $k) => "$k: $v")->implode("\n") : '') }}</textarea>
            </div>
        </div>

        <div class="form-card">
            <h2>Image</h2>
            @if($product->image_path)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $product->image_path) }}" alt="{{ $product->name }}">
                    <label class="checkbox-label">
                        <input type="checkbox" name="delete_image" value="1">
                        Delete primary image
                    </label>
                </div>
            @endif
            <div class="form-group">
                <label for="image">Upload New Primary Image</label>
                <input type="file" id="image" name="image" accept="image/*" data-preview="image-preview">
                <small>Recommended: 600x450px, max 2MB</small>
                <div class="image-preview"><img id="image-preview" src="" alt="Preview" style="display:none"></div>
                @error('image')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label for="thumbnails">Add More Thumbnails</label>
                <input type="file" id="thumbnails" name="thumbnails[]" accept="image/*" multiple data-preview="thumbnails-preview">
                <small>You can select multiple images</small>
                <div class="image-preview"><img id="thumbnails-preview" src="" alt="Preview" style="display:none"></div>
                @error('thumbnails.*')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-card">
            <h2>SEO</h2>
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $product->meta_title) }}" maxlength="60" class="form-input">
                <small>Recommended: 50-60 characters. Leave empty to use product name.</small>
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="form-textarea">{{ old('meta_description', $product->meta_description) }}</textarea>
                <small>Recommended: 150-160 characters. Used in search engine results.</small>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.products.index') }}" class="btn btn--ghost">Cancel</a>
        <button type="submit" class="btn btn--primary">Update Product</button>
    </div>
</form>

@if($product->images->count())
<div class="admin-form" style="margin-top: 24px;">
    <div class="form-card">
        <h2>Manage Thumbnails</h2>
        <p style="margin-bottom: 12px; color: var(--admin-text-muted);">Click "Use as Primary" to set a thumbnail as the main product image. The current primary image will move to thumbnails.</p>
        <div class="thumbnail-grid">
            @foreach($product->images as $image)
                <div class="thumbnail-item">
                    <img src="{{ asset('storage/' . $image->path) }}" alt="Thumbnail">
                    <div class="thumbnail-actions">
                        <form action="{{ route('admin.products.set-primary', [$product->id, $image->id]) }}" method="POST" data-disable-on-submit>
                            @csrf
                            <button type="submit" class="btn btn--small btn--primary">Use as Primary</button>
                        </form>
                        <button type="button" class="btn btn--small btn--danger" onclick="openDeleteModal('{{ route('admin.products.update', $product->id) }}?delete_thumb={{ $image->id }}', 'this thumbnail')">Delete</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endif
@endsection
