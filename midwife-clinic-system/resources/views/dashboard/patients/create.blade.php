@extends('layouts.app')

@section('title', '- Add New Patient')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-user-plus text-primary me-2"></i>Add New Patient
                    </h1>
                    <p class="text-muted mb-0">Register a new patient to the system</p>
                </div>
                <div>
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Patients
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-4">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user-edit text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Patient Information</h5>
                            <small class="text-muted">Fill in the required patient details below</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('patients.store') }}" method="POST" id="patientForm">
                        @csrf
                        
                        <!-- Personal Information Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="fas fa-id-card text-primary me-2"></i>Personal Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="name" class="form-label fw-semibold">
                                        Full Name <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-user text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{ old('name') }}" 
                                               placeholder="Enter full name"
                                               required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="nik" class="form-label fw-semibold">
                                        NIK (Identity Number) <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-id-badge text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('nik') is-invalid @enderror" 
                                               id="nik" 
                                               name="nik" 
                                               value="{{ old('nik') }}" 
                                               placeholder="16-digit NIK"
                                               maxlength="16"
                                               pattern="[0-9]{16}"
                                               required>
                                        @error('nik')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Enter 16-digit National Identity Number</small>
                                </div>
                            </div>
                        </div>

                        <!-- Birth Information Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="fas fa-birthday-cake text-primary me-2"></i>Birth Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="place_of_birth" class="form-label fw-semibold">
                                        Place of Birth <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-map-marker-alt text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               class="form-control @error('place_of_birth') is-invalid @enderror" 
                                               id="place_of_birth" 
                                               name="place_of_birth" 
                                               value="{{ old('place_of_birth') }}" 
                                               placeholder="City/Regency of birth"
                                               required>
                                        @error('place_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="date_of_birth" class="form-label fw-semibold">
                                        Date of Birth <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-calendar text-muted"></i>
                                        </span>
                                        <input type="date" 
                                               class="form-control @error('date_of_birth') is-invalid @enderror" 
                                               id="date_of_birth" 
                                               name="date_of_birth" 
                                               value="{{ old('date_of_birth') }}" 
                                               max="{{ date('Y-m-d') }}"
                                               required>
                                        @error('date_of_birth')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Age will be calculated automatically</small>
                                </div>
                            </div>
                        </div>

                        <!-- Contact Information Section -->
                        <div class="mb-4">
                            <h6 class="fw-bold text-dark mb-3 d-flex align-items-center">
                                <i class="fas fa-address-book text-primary me-2"></i>Contact Information
                            </h6>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="phone" class="form-label fw-semibold">
                                        Phone Number <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light">
                                            <i class="fas fa-phone text-muted"></i>
                                        </span>
                                        <input type="tel" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{ old('phone') }}" 
                                               placeholder="08xx-xxxx-xxxx"
                                               required>
                                        @error('phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <label for="address" class="form-label fw-semibold">
                                        Address <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light align-items-start pt-2">
                                            <i class="fas fa-home text-muted"></i>
                                        </span>
                                        <textarea class="form-control @error('address') is-invalid @enderror" 
                                                  id="address" 
                                                  name="address" 
                                                  rows="3" 
                                                  placeholder="Complete address"
                                                  required>{{ old('address') }}</textarea>
                                        @error('address')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="d-flex justify-content-between pt-4 border-top">
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Cancel
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>Save Patient
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // NIK validation
    const nikInput = document.getElementById('nik');
    nikInput.addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, '');
        if (this.value.length > 16) {
            this.value = this.value.slice(0, 16);
        }
    });

    // Phone number formatting
    const phoneInput = document.getElementById('phone');
    phoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.startsWith('0')) {
            value = value;
        } else if (value.startsWith('62')) {
            value = '0' + value.slice(2);
        }
        this.value = value;
    });

    // Age display
    const dobInput = document.getElementById('date_of_birth');
    dobInput.addEventListener('change', function() {
        if (this.value) {
            const birthDate = new Date(this.value);
            const today = new Date();
            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();
            
            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            
            const helpText = this.parentNode.parentNode.querySelector('small');
            if (helpText) {
                helpText.textContent = `Age: ${age} years old`;
                helpText.className = 'text-info';
            }
        }
    });
});
</script>
@endsection