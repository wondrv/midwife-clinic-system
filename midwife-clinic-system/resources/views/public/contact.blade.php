@extends('public.layout')

@section('title', 'Contact Us')

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <h1 class="h2 mb-0">Contact Us</h1>
        <p class="lead mb-0">Get in touch with our clinic</p>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">Send us a Message</h4>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('public.contact.submit') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name *</label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                               id="email" name="email" value="{{ old('email') }}" required>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Phone Number *</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                       id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <select class="form-select @error('subject') is-invalid @enderror" id="subject" name="subject">
                                    <option value="">Select a subject...</option>
                                    <option value="general" {{ old('subject') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                                    <option value="appointment" {{ old('subject') == 'appointment' ? 'selected' : '' }}>Appointment Request</option>
                                    <option value="services" {{ old('subject') == 'services' ? 'selected' : '' }}>Services Information</option>
                                    <option value="emergency" {{ old('subject') == 'emergency' ? 'selected' : '' }}>Emergency</option>
                                </select>
                                @error('subject')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Message *</label>
                                <textarea class="form-control @error('message') is-invalid @enderror" 
                                          id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-paper-plane me-2"></i>Send Message
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h4 class="mb-0">Contact Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h6 class="text-primary"><i class="fas fa-map-marker-alt me-2"></i>Address</h6>
                            <p class="mb-0">Jl. Kesehatan No. 123<br>Jakarta Selatan, 12345<br>Indonesia</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-primary"><i class="fas fa-phone me-2"></i>Phone</h6>
                            <p class="mb-0">(021) 123-4567<br>0812-3456-7890</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-primary"><i class="fas fa-envelope me-2"></i>Email</h6>
                            <p class="mb-0">info@midwifeclinic.com<br>admin@midwifeclinic.com</p>
                        </div>

                        <div class="mb-4">
                            <h6 class="text-primary"><i class="fas fa-clock me-2"></i>Operating Hours</h6>
                            <p class="mb-0">
                                Monday - Friday: 8:00 AM - 6:00 PM<br>
                                Saturday: 9:00 AM - 4:00 PM<br>
                                Sunday: 10:00 AM - 2:00 PM<br>
                                <small class="text-danger">24/7 Emergency Service Available</small>
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Emergency Notice -->
                <div class="alert alert-danger mt-4">
                    <h6 class="alert-heading"><i class="fas fa-exclamation-triangle me-2"></i>Emergency?</h6>
                    <p class="mb-0">For medical emergencies, please call <strong>(021) 123-4567</strong> immediately or visit our clinic directly.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
