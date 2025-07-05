@extends('public.layout')

@section('title', app()->getLocale() == 'id' ? 'Selamat Datang' : 'Welcome')

@section('content')
<!-- Hero Section -->
<section class="hero-section text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">
                    @if(app()->getLocale() == 'id')
                        Perawatan Bidan Profesional
                    @else
                        Professional Midwife Care
                    @endif
                </h1>
                <p class="lead mb-4">
                    @if(app()->getLocale() == 'id')
                        Memberikan perawatan maternal yang penuh kasih dan ahli dengan fasilitas modern dan bidan berpengalaman.
                    @else
                        Providing compassionate and expert maternal care with modern facilities and experienced midwives.
                    @endif
                </p>
                <a href="{{ route('public.services') }}" class="btn btn-light btn-lg">
                    @if(app()->getLocale() == 'id')
                        Lihat Layanan Kami
                    @else
                        View Our Services
                    @endif
                </a>
            </div>
            <div class="col-lg-6">
                <img src="https://via.placeholder.com/500x400/667eea/ffffff?text=Midwife+Care" class="img-fluid rounded" alt="Midwife Care">
            </div>
        </div>
    </div>
</section>

<!-- Services Preview -->
<section class="py-5">
    <div class="container">
        <h2 class="text-center mb-5">
            @if(app()->getLocale() == 'id')
                Layanan Kami
            @else
                Our Services
            @endif
        </h2>
        <div class="row">
            @foreach($services->take(3) as $service)
            <div class="col-md-4 mb-4">
                <div class="card service-card h-100 border-0 shadow">
                    <div class="card-body text-center">
                        <i class="fas fa-stethoscope text-primary fs-1 mb-3"></i>
                        <h5 class="card-title">{{ $service->name }}</h5>
                        <p class="text-muted">
                            @if(app()->getLocale() == 'id')
                                Layanan profesional yang disediakan oleh bidan berpengalaman kami
                            @else
                                Professional services provided by our experienced midwives
                            @endif
                        </p>
                        <h4 class="text-primary">Rp {{ number_format($service->price, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.services') }}" class="btn btn-primary">
                @if(app()->getLocale() == 'id')
                    Lihat Semua Layanan
                @else
                    View All Services
                @endif
            </a>
        </div>
    </div>
</section>

<!-- Contact Info -->
<section class="bg-light py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-map-marker-alt text-primary fs-1 mb-3"></i>
                <h5>
                    @if(app()->getLocale() == 'id')
                        Alamat
                    @else
                        Address
                    @endif
                </h5>
                <p>Jl. Kesehatan No. 123, Surabaya, Jawa Timur</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-phone text-primary fs-1 mb-3"></i>
                <h5>
                    @if(app()->getLocale() == 'id')
                        Telepon
                    @else
                        Phone
                    @endif
                </h5>
                <p>+62 31 1234 5678</p>
            </div>
            <div class="col-md-4 text-center mb-4">
                <i class="fas fa-clock text-primary fs-1 mb-3"></i>
                <h5>
                    @if(app()->getLocale() == 'id')
                        Jam Kerja
                    @else
                        Hours
                    @endif
                </h5>
                <p>
                    @if(app()->getLocale() == 'id')
                        Sen - Jum: 08:00 - 17:00
                    @else
                        Mon - Fri: 8:00 AM - 5:00 PM
                    @endif
                </p>
            </div>
        </div>
    </div>
</section>
@endsection