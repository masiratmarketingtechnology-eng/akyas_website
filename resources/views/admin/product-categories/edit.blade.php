@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Edit Product Category</h1>
    <p>Update {{ $category->name }}</p>
</div>

<div class="form-card" style="max-width: 500px;">
    <form method="POST" action="{{ route('admin.product-categories.update', $category->id) }}" data-disable-on-submit>
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category Name <span class="required">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name', $category->name) }}" class="form-input @error('name') is-error @enderror" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>

        <div class="form-divider"></div>

        <h2>SEO</h2>
        <div class="form-group">
            <label for="meta_title">Meta Title</label>
            <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $category->meta_title) }}" maxlength="60" class="form-input">
            <small>Recommended: 50-60 characters. Leave empty to use category name.</small>
        </div>
        <div class="form-group">
            <label for="meta_description">Meta Description</label>
            <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="form-textarea">{{ old('meta_description', $category->meta_description) }}</textarea>
            <small>Recommended: 150-160 characters. Used in search engine results.</small>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.product-categories.index') }}" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Update Category</button>
        </div>
    </form>
</div>
@endsection
