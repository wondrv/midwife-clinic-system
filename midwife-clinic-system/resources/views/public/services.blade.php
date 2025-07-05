@extends('public.layout')

@section('title', __('app.services'))

@section('content')
<!-- Page Header -->
<section class="bg-primary text-white py-4">
    <div class="container">
        <h1 class="h2 mb-0">{{ __('app.our_services') }}</h1>
        <p class="lead mb-0">{{ __('app.professional_maternal_healthcare') }}</p>
    </div>
</section>

<!-- Services List -->
<section class="py-5">
    <div class="container">
        <div class="row">
            @forelse($services as $service)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card service-card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-stethoscope text-primary fs-1 mb-3"></i>
                        <h5 class="card-title">{{ $service->name }}</h5>
                        @if($service->description)
                            <p class="text-muted">{{ $service->description }}</p>
                        @endif
                        <h4 class="text-primary">Rp {{ number_format($service->price, 0, ',', '.') }}</h4>
                    </div>
                    <div class="card-footer bg-transparent border-0 text-center">
                        <small class="text-muted">{{ __('app.professional_service_by_midwives') }}</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <div class="alert alert-info">
                    <h5>{{ __('app.services_coming_soon') }}</h5>
                    <p class="mb-0">{{ __('app.updating_service_offerings') }}</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="bg-light py-5">
    <div class="container text-center">
        <h3 class="mb-4">{{ __('app.need_consultation') }}</h3>
        <p class="lead mb-4">{{ __('app.contact_for_appointment') }}</p>
        <a href="{{ route('public.contact') }}" class="btn btn-primary btn-lg">{{ __('app.contact_us') }}</a>
    </div>
</section>
@endsection
