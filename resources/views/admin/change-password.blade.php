@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Change Password</h1>
    <p>Update your admin password</p>
</div>

<div class="form-card" style="max-width: 500px;">
    <form method="POST" action="{{ route('admin.password.update') }}" data-disable-on-submit>
        @csrf
        <div class="form-group">
            <label for="current_password">Current Password <span class="required">*</span></label>
            <input type="password" id="current_password" name="current_password" class="form-input @error('current_password') is-error @enderror" required>
            @error('current_password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password">New Password <span class="required">*</span></label>
            <input type="password" id="password" name="password" class="form-input @error('password') is-error @enderror" required minlength="8">
            <small>Minimum 8 characters</small>
            @error('password')<span class="field-error">{{ $message }}</span>@enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm New Password <span class="required">*</span></label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" required minlength="8">
        </div>
        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Change Password</button>
        </div>
    </form>
</div>
@endsection