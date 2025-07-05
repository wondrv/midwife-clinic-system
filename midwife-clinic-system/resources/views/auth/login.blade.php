<x-guest-layout>
<!-- Left Side - Branding -->
<div class="col-lg-5 d-none d-lg-block">
    <div class="auth-left h-100">
        <div class="floating-shapes"></div>
        <div class="position-relative z-3">
            <div class="brand-logo">
                <i class="fas fa-user-md fa-2x text-white"></i>
            </div>
            <h2 class="fw-bold mb-3">Welcome to Midwife Clinic</h2>
            <p class="mb-4 opacity-90">Your trusted healthcare management system. Providing comprehensive maternal and child healthcare services with modern technology.</p>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-20 p-2 me-3">
                        <i class="fas fa-shield-alt text-white"></i>
                    </div>
                    <span>Secure & HIPAA Compliant</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-20 p-2 me-3">
                        <i class="fas fa-clock text-white"></i>
                    </div>
                    <span>24/7 System Availability</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-20 p-2 me-3">
                        <i class="fas fa-heart text-white"></i>
                    </div>
                    <span>Patient-Centered Care</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Right Side - Login Form -->
<div class="col-lg-7">
    <div class="auth-right">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-2">Sign In to Your Account</h3>
            <p class="text-muted">Enter your credentials to access the clinic management system</p>
        </div>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email Address -->
            <div class="mb-3">
                <div class="form-floating position-relative">
                    <i class="fas fa-envelope input-icon"></i>
                    <input type="email" 
                           class="form-control has-icon @error('email') is-invalid @enderror" 
                           id="email" 
                           name="email" 
                           value="{{ old('email') }}" 
                           placeholder="Enter your email address"
                           required 
                           autofocus>
                    <label for="email">Email Address</label>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <div class="form-floating position-relative">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" 
                           class="form-control has-icon @error('password') is-invalid @enderror" 
                           id="password" 
                           name="password" 
                           placeholder="Enter your password"
                           required>
                    <label for="password">Password</label>
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" onclick="togglePassword()">
                        <i class="fas fa-eye" id="toggleIcon"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label text-muted" for="remember">
                        Remember me
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <div class="auth-links">
                        <a href="{{ route('password.request') }}">Forgot Password?</a>
                    </div>
                @endif
            </div>

            <!-- Login Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg" id="loginBtn">
                    <span class="btn-text">
                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                    </span>
                    <div class="spinner-border spinner-border-sm me-2 d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>

            <!-- Register Link -->
            @if (Route::has('register'))
                <div class="text-center auth-links">
                    <span class="text-muted">Don't have an account? </span>
                    <a href="{{ route('register') }}">Create Account</a>
                </div>
            @endif
        </form>

        <!-- Demo Credentials -->
        <div class="mt-4 p-3 bg-light rounded">
            <h6 class="fw-bold text-muted mb-2">
                <i class="fas fa-info-circle me-1"></i>Demo Credentials
            </h6>
            <div class="row">
                <div class="col-md-6">
                    <small class="text-muted d-block">Admin:</small>
                    <small class="fw-medium">admin@example.com</small>
                </div>
                <div class="col-md-6">
                    <small class="text-muted d-block">Password:</small>
                    <small class="fw-medium">password</small>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        toggleIcon.classList.remove('fa-eye');
        toggleIcon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        toggleIcon.classList.remove('fa-eye-slash');
        toggleIcon.classList.add('fa-eye');
    }
}

// Form submission with loading state
document.getElementById('loginForm').addEventListener('submit', function() {
    const btn = document.getElementById('loginBtn');
    const btnText = btn.querySelector('.btn-text');
    const spinner = btn.querySelector('.spinner-border');
    
    btn.disabled = true;
    btnText.classList.add('d-none');
    spinner.classList.remove('d-none');
});

// Auto-fill demo credentials
function fillDemoCredentials() {
    document.getElementById('email').value = 'admin@example.com';
    document.getElementById('password').value = 'password';
}

// Add click event to demo credentials
document.querySelector('.bg-light').addEventListener('click', fillDemoCredentials);
</script>
</x-guest-layout>
