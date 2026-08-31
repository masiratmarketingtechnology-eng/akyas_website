@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Add Staff User</h1>
    <p>Create a new staff account</p>
</div>

<div class="form-card" style="max-width: 500px;">
    <form method="POST" action="{{ route('admin.staff-users.store') }}" data-disable-on-submit>
        @csrf
        <div class="form-group">
            <label for="name">Full Name <span class="required">*</span></label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-input @error('name') is-error @enderror" required>
            @error('name')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="email">Email Address <span class="required">*</span></label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input @error('email') is-error @enderror" required>
            @error('email')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password">Password <span class="required">*</span></label>
            <input type="password" id="password" name="password" class="form-input @error('password') is-error @enderror" required>
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password <span class="required">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required>
        </div>
        <div class="form-actions">
            <a href="{{ route('admin.staff-users.index') }}" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Create Staff User</button>
        </div>
    </form>
</div>
@endsection
