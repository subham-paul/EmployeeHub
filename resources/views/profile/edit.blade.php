@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h1 class="mb-4">Profile Settings</h1>

        @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Profile information updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('status') === 'password-updated')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Password updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('status') === 'profile-deleted')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                Your account has been deleted.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->userDeletion->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                There was an error deleting your account. Please check your password.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif


        <div class="row">
            <div class="col-md-8">
                {{-- Profile Information Update --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Profile Information</h5>
                        <p class="card-text text-muted">Update your account's profile information and email address.</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('profile.update') }}" class="mt-3">
                            @csrf
                            @method('patch')

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2 text-muted">
                                        Your email address is unverified.
                                        <button form="send-verification" class="btn btn-link p-0 m-0 align-baseline">{{ __('Click here to re-send the verification email.') }}</button>
                                    </div>

                                    @if (session('status') === 'verification-link-sent')
                                        <div class="mt-2 font-weight-bold text-success">
                                            {{ __('A new verification link has been sent to your email address.') }}
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <div class="d-flex align-items-center gap-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Update Password --}}
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Update Password</h5>
                        <p class="card-text text-muted">Ensure your account is using a long, random password to stay secure.</p>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('password.update') }}" class="mt-3">
                            @csrf
                            @method('put')

                            <div class="mb-3">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input id="current_password" name="current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" autocomplete="current-password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">New Password</label>
                                <input id="password" name="password" type="password" class="form-control @error('password') is-invalid @enderror" autocomplete="new-password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="new-password">
                                @error('password_confirmation')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex align-items-center gap-4">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>
                    </div>
                </div>

                {{-- Delete Account --}}
                <div class="card mb-4 border-danger">
                    <div class="card-header bg-danger text-white">
                        <h5 class="card-title mb-0">Delete Account</h5>
                        <p class="card-text">Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">Delete Account</button>

                        <!-- Delete User Confirmation Modal -->
                        <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <form method="post" action="{{ route('profile.destroy') }}" class="p-4">
                                        @csrf
                                        @method('delete')

                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmUserDeletionModalLabel">Are you sure you want to delete your account?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p class="mt-1 text-muted">
                                                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.
                                            </p>

                                            <div class="mb-3">
                                                <label for="password" class="form-label sr-only">Password</label>
                                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                                                @error('password', 'userDeletion')
                                                    <div class="text-danger mt-2">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete Account</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
