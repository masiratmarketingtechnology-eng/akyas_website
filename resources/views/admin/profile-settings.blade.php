@extends('admin.layout')
@section('content')
<div class="page-header">
    <h1>Profile Settings</h1>
    <p>Manage your account settings</p>
</div>

<div class="form-card" style="max-width: 600px;">
    <form method="POST" action="{{ route('admin.profile.update') }}" data-disable-on-submit>
        @csrf
        @method('PUT')

        <div class="form-section">
            <h2 class="form-section__title">Personal Information</h2>
            <div class="form-group">
                <label for="name">Name <span class="required">*</span></label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->user()->name) }}" class="form-input @error('name') is-error @enderror" required>
                @error('name')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="email">Email <span class="required">*</span></label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" class="form-input @error('email') is-error @enderror" required>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-divider"></div>

        <div class="form-section">
            <h2 class="form-section__title">Enquiry Notification</h2>
            <p class="form-section__desc">New enquiries from the website contact form will be sent to this email address.</p>
            <div class="form-group">
                <label for="notification_email">Notification Email</label>
                <input type="email" id="notification_email" name="notification_email" value="{{ old('notification_email', auth()->user()->notification_email) }}" placeholder="e.g. sales@omanplastic.com" class="form-input @error('notification_email') is-error @enderror">
                @error('notification_email')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-divider"></div>

        <div class="form-section">
            <h2 class="form-section__title">WhatsApp</h2>
            <p class="form-section__desc">WhatsApp number displayed on the website chat buttons (with country code, e.g. 96894566722).</p>
            <div class="form-group">
                <label for="whatsapp_number">WhatsApp Number</label>
                <input type="text" id="whatsapp_number" name="whatsapp_number" value="{{ old('whatsapp_number', auth()->user()->whatsapp_number) }}" placeholder="e.g. 96894566722" class="form-input @error('whatsapp_number') is-error @enderror">
                @error('whatsapp_number')<span class="field-error">{{ $message }}</span>@enderror
            </div>
        </div>

        <div class="form-divider"></div>

        <div class="form-section">
            <h2 class="form-section__title">Change Password</h2>
            <p class="form-section__desc">Leave password fields blank to keep current password.</p>
            <div class="form-group">
                <label for="current_password">Current Password <span class="required">*</span></label>
                <input type="password" id="current_password" name="current_password" class="form-input @error('current_password') is-error @enderror" required>
                @error('current_password')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="password">New Password</label>
                <input type="password" id="password" name="password" class="form-input @error('password') is-error @enderror">
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-input">
            </div>
        </div>

        <div class="form-actions">
            <a href="{{ route('admin.dashboard') }}" class="btn btn--ghost">Cancel</a>
            <button type="submit" class="btn btn--primary">Update Profile</button>
        </div>
    </form>
</div>
@endsection
