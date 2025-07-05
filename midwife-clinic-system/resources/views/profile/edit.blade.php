@extends('layouts.app')

@section('title', '- ' . __('app.profile'))

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-user-cog text-primary me-2"></i>{{ __('app.profile_settings') }}
                    </h1>
                    <p class="text-muted mb-0">{{ __('app.manage_account_settings') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Profile Information -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-user text-primary me-2"></i>{{ __('app.profile_information') }}
                    </h5>
                    <p class="text-muted mb-0 mt-1">{{ __('app.update_profile_info') }}</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')
                        
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">{{ __('app.name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                       id="name" name="name" value="{{ old('name', $user->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="email" class="form-label">{{ __('app.email') }}</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                       id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                
                                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                    <div class="mt-2">
                                        <p class="text-warning">
                                            {{ __('app.email_unverified') }}
                                            <button form="send-verification" class="btn btn-link p-0 text-decoration-underline">
                                                {{ __('app.resend_verification') }}
                                            </button>
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-3 mt-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>{{ __('app.save') }} {{ __('app.changes') }}
                            </button>
                            
                            @if (session('status') === 'profile-updated')
                                <div class="alert alert-success mb-0 py-2" role="alert">
                                    <i class="fas fa-check-circle me-1"></i>{{ __('app.profile_updated_successfully') }}
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Account Information -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-info-circle text-info me-2"></i>Account Information
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold">{{ $user->name }}</h6>
                            <small class="text-muted">{{ ucfirst($user->role) }}</small>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="mb-3">
                        <strong class="text-muted">Email:</strong>
                        <div>{{ $user->email }}</div>
                        @if ($user->email_verified_at)
                            <small class="text-success">
                                <i class="fas fa-check-circle me-1"></i>Verified
                            </small>
                        @else
                            <small class="text-warning">
                                <i class="fas fa-exclamation-triangle me-1"></i>Unverified
                            </small>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <strong class="text-muted">Member Since:</strong>
                        <div>{{ $user->created_at->format('M j, Y') }}</div>
                        <small class="text-muted">{{ $user->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mt-2">
        <!-- Change Password -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-lock text-warning me-2"></i>Change Password
                    </h5>
                    <p class="text-muted mb-0 mt-1">Ensure your account is using a long, random password to stay secure.</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <div class="col-12">
                                <label for="current_password" class="form-label">Current Password</label>
                                <input type="password" class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                                       id="current_password" name="current_password" required>
                                @error('current_password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password" class="form-label">New Password</label>
                                <input type="password" class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                                       id="password" name="password" required>
                                @error('password', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                                       id="password_confirmation" name="password_confirmation" required>
                                @error('password_confirmation', 'updatePassword')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-flex align-items-center gap-3 mt-4">
                            <button type="submit" class="btn btn-warning">
                                <i class="fas fa-key me-1"></i>Update Password
                            </button>
                            
                            @if (session('status') === 'password-updated')
                                <div class="alert alert-success mb-0 py-2" role="alert">
                                    <i class="fas fa-check-circle me-1"></i>Password updated successfully!
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Danger Zone -->
        <div class="col-lg-4">
            <div class="card border-danger shadow-sm">
                <div class="card-header bg-danger bg-opacity-10 border-danger py-3">
                    <h5 class="mb-0 fw-bold text-danger">
                        <i class="fas fa-exclamation-triangle me-2"></i>Danger Zone
                    </h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Once your account is deleted, all of its resources and data will be permanently deleted.</p>
                    
                    <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="fas fa-trash me-1"></i>Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-labelledby="deleteAccountModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger" id="deleteAccountModalLabel">
                    <i class="fas fa-exclamation-triangle me-2"></i>Delete Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')
                
                <div class="modal-body">
                    <p class="text-muted">Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.</p>
                    
                    <div class="mt-3">
                        <label for="password_delete" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                               id="password_delete" name="password" required>
                        @error('password', 'userDeletion')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Delete Account
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Verification Form -->
@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
@endif
@endsection
