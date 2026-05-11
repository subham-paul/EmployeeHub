@extends('layouts.guest')

@section('content')
<div class="mb-4 text-muted text-center">
    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
</div>

<!-- Session Status -->
@if (session('status'))
<div class="alert alert-success mb-4" role="alert">
    {{ session('status') }}
</div>
@endif

<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- Email Address -->
    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
        @error('email')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
        @enderror
    </div>

    <div class="d-grid gap-2 mt-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Email Password Reset Link') }}
        </button>
    </div>

    <div class="text-center mt-3">
        <p class="mb-0"><a href="{{ route('login') }}" class="text-decoration-none">Back to Login</a></p>
    </div>
</form>
@endsection