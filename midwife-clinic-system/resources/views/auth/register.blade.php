<x-guest-layout>
<!-- Left Side - Branding -->
<div class="col-lg-5 d-none d-lg-block">
    <div class="auth-left h-100">
        <div class="floating-shapes"></div>
        <div class="position-relative z-3">
            <div class="brand-logo">
                <i class="fas fa-hospital fa-2x text-white"></i>
            </div>
            <h2 class="fw-bold mb-3">Join Our Healthcare Team</h2>
            <p class="mb-4 opacity-90">Create your account to access the comprehensive clinic management system and start providing exceptional patient care.</p>
            <div class="d-flex flex-column gap-3">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-20 p-2 me-3">
                        <i class="fas fa-user-plus text-white"></i>
                    </div>
                    <span>Easy Account Setup</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-20 p-2 me-3">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <span>Team Collaboration</span>
                </div>
                <div class="d-flex align-items-center">
                    <div class="rounded-circle bg-white bg-opacity-20 p-2 me-3">
                        <i class="fas fa-chart-line text-white"></i>
                    </div>
                    <span>Advanced Analytics</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Right Side - Register Form -->
<div class="col-lg-7">
    <div class="auth-right">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-dark mb-2">Create Your Account</h3>
            <p class="text-muted">Join our healthcare management platform</p>
        </div>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle me-2"></i>Please fix the following errors:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <!-- Full Name -->
            <div class="mb-3">
                <div class="form-floating position-relative">
                    <i class="fas fa-user input-icon"></i>
                    <input type="text" 
                           class="form-control has-icon @error('name') is-invalid @enderror" 
                           id="name" 
                           name="name" 
                           value="{{ old('name') }}" 
                           placeholder="Enter your full name"
                           required 
                           autofocus>
                    <label for="name">Full Name</label>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

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
                           required>
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
                           placeholder="Create a password"
                           required>
                    <label for="password">Password</label>
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" onclick="togglePassword('password', 'toggleIcon1')">
                        <i class="fas fa-eye" id="toggleIcon1"></i>
                    </button>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-text">
                    <small class="text-muted">Password must be at least 8 characters long</small>
                </div>
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <div class="form-floating position-relative">
                    <i class="fas fa-lock input-icon"></i>
                    <input type="password" 
                           class="form-control has-icon @error('password_confirmation') is-invalid @enderror" 
                           id="password_confirmation" 
                           name="password_confirmation" 
                           placeholder="Confirm your password"
                           required>
                    <label for="password_confirmation">Confirm Password</label>
                    <button type="button" class="btn btn-link position-absolute end-0 top-50 translate-middle-y pe-3" onclick="togglePassword('password_confirmation', 'toggleIcon2')">
                        <i class="fas fa-eye" id="toggleIcon2"></i>
                    </button>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Terms and Conditions -->
            <div class="mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="terms" required>
                    <label class="form-check-label text-muted" for="terms">
                        I agree to the <a href="#" class="auth-links">Terms of Service</a> and <a href="#" class="auth-links">Privacy Policy</a>
                    </label>
                </div>
            </div>

            <!-- Register Button -->
            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary btn-lg" id="registerBtn">
                    <span class="btn-text">
                        <i class="fas fa-user-plus me-2"></i>Create Account
                    </span>
                    <div class="spinner-border spinner-border-sm me-2 d-none" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>

            <!-- Login Link -->
            <div class="text-center auth-links">
                <span class="text-muted">Already have an account? </span>
                <a href="{{ route('login') }}">Sign In</a>
            </div>
        </form>

        <!-- Admin Note -->
        <div class="mt-4 p-3 bg-warning bg-opacity-10 border border-warning border-opacity-25 rounded">
            <h6 class="fw-bold text-warning mb-2">
                <i class="fas fa-info-circle me-1"></i>Registration Note
            </h6>
            <small class="text-muted">
                New user accounts require admin approval before access is granted. You will receive an email notification once your account is activated.
            </small>
        </div>
    </div>
</div>

<script>
function togglePassword(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const toggleIcon = document.getElementById(iconId);
    
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
document.getElementById('registerForm').addEventListener('submit', function() {
    const btn = document.getElementById('registerBtn');
    const btnText = btn.querySelector('.btn-text');
    const spinner = btn.querySelector('.spinner-border');
    
    btn.disabled = true;
    btnText.classList.add('d-none');
    spinner.classList.remove('d-none');
});

// Password strength indicator
document.getElementById('password').addEventListener('input', function() {
    const password = this.value;
    const strength = calculatePasswordStrength(password);
    // You can add password strength indicator here
});

function calculatePasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (/[a-z]/.test(password)) strength++;
    if (/[A-Z]/.test(password)) strength++;
    if (/[0-9]/.test(password)) strength++;
    if (/[^A-Za-z0-9]/.test(password)) strength++;
    return strength;
}
</script>
</x-guest-layout>
