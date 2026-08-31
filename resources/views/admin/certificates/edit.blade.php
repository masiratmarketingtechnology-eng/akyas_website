@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Edit Certificate</h1>
    <p>{{ $certificate->title }}</p>
</div>

<form method="POST" action="{{ route('admin.certificates.update', $certificate->id) }}" enctype="multipart/form-data" class="admin-form" data-disable-on-submit>
    @csrf
    @method('PUT')
    <div class="form-grid">
        <div class="form-card">
            <h2>Basic Info</h2>
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $certificate->title) }}" class="form-input @error('title') is-error @enderror" required>
                @error('title')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="tagline">Tagline</label>
                <textarea id="tagline" name="tagline" rows="3" class="form-textarea">{{ old('tagline', $certificate->tagline) }}</textarea>
            </div>
            <div class="form-group">
                <label for="sort_order">Sort Order</label>
                <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $certificate->sort_order) }}" class="form-input">
            </div>
        </div>

        <div class="form-card">
            <h2>Files</h2>
            <div class="form-group">
                <label>Current File</label>
                <div class="cert-file-preview">
                    @if($certificate->file_type === 'pdf')
                        <a href="{{ asset('storage/' . $certificate->file_path) }}" target="_blank" class="cert-file-preview__link">
                            <i class="fa-solid fa-file-pdf"></i>
                            <span>View PDF</span>
                        </a>
                    @else
                        <img src="{{ asset('storage/' . $certificate->file_path) }}" alt="{{ $certificate->title }}">
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="file">Replace Certificate File</label>
                <input type="file" id="file" name="file" accept=".jpg,.jpeg,.png,.pdf">
                <small>Leave empty to keep current. Max 10MB</small>
                @error('file')<span class="field-error">{{ $message }}</span>@enderror
            </div>

            <div class="form-group">
                <label>Current Thumbnail</label>
                @if($certificate->thumbnail_path)
                    <div class="cert-file-preview">
                        <img src="{{ asset('storage/' . $certificate->thumbnail_path) }}" alt="Thumbnail">
                        <label class="checkbox-label">
                            <input type="checkbox" name="delete_thumbnail" value="1">
                            Delete thumbnail
                        </label>
                    </div>
                @else
                    <p class="text-muted">No thumbnail set</p>
                @endif
            </div>
            <div class="form-group">
                <label for="thumbnail">Upload New Thumbnail</label>
                <input type="file" id="thumbnail" name="thumbnail" accept=".jpg,.jpeg,.png" data-preview="thumbnail-preview">
                <small>Leave empty to keep current. Max 2MB</small>
                <div class="image-preview"><img id="thumbnail-preview" src="" alt="Preview" style="display:none"></div>
                @error('thumbnail')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.certificates.index') }}" class="btn btn--ghost">Cancel</a>
        <button type="submit" class="btn btn--primary">Update Certificate</button>
    </div>
</form>
@endsection