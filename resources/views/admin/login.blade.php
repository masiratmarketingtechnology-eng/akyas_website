@extends('admin.layout')

@section('auth-content')
<div class="admin-login">
    <div class="admin-login__card">
        <div class="admin-login__header">
            <img src="{{ asset('images/logo.png') }}" alt="Akyas" width="60" height="60">
            <h1>Akyas Admin</h1>
            <p>Sign in to manage your website</p>
        </div>

        @if($errors->any())
            <div class="alert alert--error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.submit') }}" data-disable-on-submit>
            @csrf
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-input @error('email') is-error @enderror" required autofocus>
                @error('email')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-input @error('password') is-error @enderror" required>
                @error('password')<span class="field-error">{{ $message }}</span>@enderror
            </div>
            <div class="form-group form-group--row">
                <label class="checkbox-label">
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>
            <button type="submit" class="btn btn--primary btn--full">Sign In</button>
        </form>
    </div>
</div>
@endsection
