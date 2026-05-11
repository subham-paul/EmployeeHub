@extends('layouts.guest')

@section('content')
<!-- Session Status -->
@if (session('status'))
<div class="alert alert-success mb-4" role="alert">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus autocomplete="username">
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Password -->
    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
        @error('password')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <!-- Remember Me and Forgot Password -->
    <!-- <div class="d-flex justify-content-between align-items-center mb-3">
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">{{ __('Remember me') }}</label>
            </div>

            @if (Route::has('password.request'))
                <a class="text-decoration-none" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div> -->

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            {{ __('Log in') }}
        </button>
    </div>

    <div class="text-center mt-3">
        <p class="mb-0">Don't have an account? <a class="btn btn-sm btn-outline-success" href="{{ route('register') }}" class="text-decoration-none">Register here</a></p>
    </div>
</form>
@endsection