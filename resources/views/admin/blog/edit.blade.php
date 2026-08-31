@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Edit Blog Post</h1>
    <p>Update {{ $post->title }}</p>
</div>

<form method="POST" action="{{ route('admin.blog.update', $post->id) }}" enctype="multipart/form-data" class="admin-form" data-disable-on-submit>
    @csrf
    @method('PUT')
    <div class="form-grid">
        <div class="form-card form-card--wide">
            <h2>Content</h2>
            <div class="form-group">
                <label for="title">Title <span class="required">*</span></label>
                <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" class="form-input @error('title') is-error @enderror" required>
                @error('title')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="content">Content <span class="required">*</span></label>
                <textarea id="content" name="content" rows="12" class="form-textarea @error('content') is-error @enderror" required>{{ old('content', $post->content) }}</textarea>
                @error('content')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-card">
            <h2>Details</h2>
            <div class="form-group">
                <label for="category_id">Category <span class="required">*</span></label>
                <select id="category_id" name="category_id" class="form-select @error('category_id') is-error @enderror" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="read_time_minutes">Read Time (minutes)</label>
                <input type="number" id="read_time_minutes" name="read_time_minutes" value="{{ old('read_time_minutes', $post->read_time_minutes) }}" min="1" class="form-input">
            </div>
            <div class="form-group">
                <label for="published_at">Publish Date</label>
                <input type="date" id="published_at" name="published_at" value="{{ old('published_at', $post->published_at?->format('Y-m-d')) }}" class="form-input">
                <small>Leave empty to save as draft</small>
            </div>
            @if($post->image_path)
                <div class="current-image">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="{{ $post->title }}">
                </div>
            @endif
            <div class="form-group">
                <label for="image">Featured Image</label>
                <input type="file" id="image" name="image" accept="image/*" data-preview="image-preview">
                <small>Recommended: 800x450px, max 2MB</small>
                <div class="image-preview"><img id="image-preview" src="" alt="Preview" style="display:none"></div>
                @error('image')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-card">
            <h2>SEO</h2>
            <div class="form-group">
                <label for="meta_title">Meta Title</label>
                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $post->meta_title) }}" maxlength="60" class="form-input">
                <small>Recommended: 50-60 characters. Leave empty to use post title.</small>
            </div>
            <div class="form-group">
                <label for="meta_description">Meta Description</label>
                <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="form-textarea">{{ old('meta_description', $post->meta_description) }}</textarea>
                <small>Recommended: 150-160 characters. Used in search engine results.</small>
            </div>
        </div>
    </div>

    <div class="form-actions">
        <a href="{{ route('admin.blog.index') }}" class="btn btn--ghost">Cancel</a>
        <button type="submit" class="btn btn--primary">Update Post</button>
    </div>
</form>
@endsection
