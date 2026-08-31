@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Add Certificate</h1>
    <p>Upload a new certificate</p>
</div>

<form method="POST" action="{{ route('admin.certificates.store') }}" enctype="multipart/form-data" class="admin-form" data-disable-on-submit>
    @csrf
    <div class="form-grid">
        <div class="form-card">
            <h2>Basic Info</h2>
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-input @error('title') is-error @enderror" required>
                @error('title')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="tagline">Tagline</label>
                <textarea id="tagline" name="tagline" rows="3" class="form-textarea">{{ old('tagline') }}</textarea>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" class="form-input">
            </div>
        </div>

        <div class="form-card">
            <h2>Files</h2>
            <div class="form-group">
                <label for="file">Certificate File <span class="required">*</span> (JPG, PNG, or PDF)</label>
                <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf" required>
                <small>Max 10MB</small>
                @error('file')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="thumbnail">Thumbnail Image (optional)</label>
                <input type="file" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png" data-preview="thumbnail-preview">
                <small>Displayed on the certificates page. Max 2MB</small>
                <div class="image-preview"><img id="thumbnail-preview" src="" alt="Preview" style="display:none"></div>
                @error('thumbnail')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.certificates.index') }}" class="btn btn--ghost">Cancel</a>
        <button type="submit" class="btn btn--primary">Create Certificate</button>
    </div>
</form>
@endsection