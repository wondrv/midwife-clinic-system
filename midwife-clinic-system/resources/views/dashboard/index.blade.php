@extends('layouts.app')

@section('title', '- ' . __('app.dashboard'))

@section('content')
<div class="container-fluid px-4">
    <!-- Welcome Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-chart-line text-primary me-2"></i>{{ __('app.dashboard') }}
                    </h1>
                    <p class="text-muted mb-0">
                        {{ __('app.welcome_back') }}, <span class="fw-semibold text-primary">{{ auth()->user()->name }}</span>! 
                        <small class="text-secondary">{{ now()->format('l, F j, Y') }}</small>
                    </p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i>{{ __('app.new_transaction') }}
                    </a>
                    @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.reports.transactions') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-chart-bar me-1"></i>{{ __('app.reports') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm stats-card bg-gradient-primary">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <div class="stats-icon bg-white bg-opacity-20 rounded-3 me-3">
                                    <i class="fas fa-users text-white fs-4"></i>
                                </div>
                                <h6 class="text-white-50 mb-0 small text-uppercase fw-bold">{{ __('app.patients_today') }}</h6>
                            </div>
                            <h2 class="text-white mb-1 fw-bold">{{ $stats['patients_today'] }}</h2>
                            <small class="text-white-50">
                                <i class="fas fa-chart-line me-1"></i>{{ __('app.total') }}: {{ $stats['total_patients'] }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm stats-card bg-gradient-success">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <div class="stats-icon bg-white bg-opacity-20 rounded-3 me-3">
                                    <i class="fas fa-rupiah-sign text-white fs-4"></i>
                                </div>
                                <h6 class="text-white-50 mb-0 small text-uppercase fw-bold">{{ __('app.revenue_today') }}</h6>
                            </div>
                            <h2 class="text-white mb-1 fw-bold">Rp {{ number_format($stats['revenue_today'], 0, ',', '.') }}</h2>
                            <small class="text-white-50">
                                <i class="fas fa-chart-line me-1"></i>{{ __('app.profit') }}: Rp {{ number_format($stats['profit_today'], 0, ',', '.') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm stats-card bg-gradient-info">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <div class="stats-icon bg-white bg-opacity-20 rounded-3 me-3">
                                    <i class="fas fa-receipt text-white fs-4"></i>
                                </div>
                                <h6 class="text-white-50 mb-0 small text-uppercase fw-bold">{{ __('app.transactions') }}</h6>
                            </div>
                            <h2 class="text-white mb-1 fw-bold">{{ $stats['transactions_today'] }}</h2>
                            <small class="text-white-50">
                                <i class="fas fa-clock me-1"></i>{{ __('app.todays_transactions') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm stats-card bg-gradient-warning">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-2">
                                <div class="stats-icon bg-white bg-opacity-20 rounded-3 me-3">
                                    <i class="fas fa-exclamation-triangle text-white fs-4"></i>
                                </div>
                                <h6 class="text-white-50 mb-0 small text-uppercase fw-bold">{{ __('app.pending_bills') }}</h6>
                            </div>
                            <h2 class="text-white mb-1 fw-bold">{{ $stats['unpaid_transactions'] }}</h2>
                            <small class="text-white-50">
                                <i class="fas fa-credit-card me-1"></i>{{ __('app.awaiting_payment') }}
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Features Row -->
    <div class="row g-4 mb-4">
        <!-- Staff Features -->
        <div class="col-lg-8">
            <div class="row g-4">
                <!-- Layanan (Services) -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 feature-card">
                        <div class="card-header bg-primary bg-opacity-10 border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="rounded-3 bg-primary bg-opacity-20 p-2">
                                        <i class="fas fa-stethoscope text-primary fs-5"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-primary">{{ __('app.services') }}</h6>
                                    <small class="text-muted">{{ __('app.services_available') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="services-list">
                                @forelse(App\Models\Service::take(5)->get() as $service)
                                <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div>
                                        <span class="fw-medium text-dark">{{ $service->name }}</span>
                                    </div>
                                    <span class="fw-bold text-success">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <i class="fas fa-stethoscope fa-2x text-muted opacity-50 mb-2"></i>
                                    <p class="text-muted mb-0">{{ __('app.no_services_available') }}</p>
                                </div>
                                @endforelse
                            </div>
                            <div class="text-center mt-3">
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.services.index') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-cog me-1"></i>{{ __('app.manage_services') }}
                                </a>
                                @else
                                <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus me-1"></i>{{ __('app.use_service') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Obat (Medicines) -->
                <div class="col-md-6">
                    <div class="card border-0 shadow-sm h-100 feature-card">
                        <div class="card-header bg-success bg-opacity-10 border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="me-3">
                                    <div class="rounded-3 bg-success bg-opacity-20 p-2">
                                        <i class="fas fa-pills text-success fs-5"></i>
                                    </div>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold text-success">{{ __('app.medicines') }}</h6>
                                    <small class="text-muted">{{ __('app.medicine_inventory') }}</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="medicines-list">
                                @forelse(App\Models\Medicine::take(5)->get() as $medicine)
                                <div class="d-flex justify-content-between align-items-center py-2 {{ !$loop->last ? 'border-bottom' : '' }}">
                                    <div class="flex-grow-1">
                                        <span class="fw-medium text-dark">{{ $medicine->name }}</span>
                                        <div class="d-flex align-items-center mt-1">
                                            <span class="badge {{ $medicine->stock < 10 ? 'bg-danger' : 'bg-info' }} bg-opacity-20 text-{{ $medicine->stock < 10 ? 'danger' : 'info' }} me-2">
                                                {{ __('app.stock') }}: {{ $medicine->stock }}
                                            </span>
                                            <span class="fw-bold text-success small">Rp {{ number_format($medicine->price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="text-center py-3">
                                    <i class="fas fa-pills fa-2x text-muted opacity-50 mb-2"></i>
                                    <p class="text-muted mb-0">{{ __('app.no_medicines_available') }}</p>
                                </div>
                                @endforelse
                            </div>
                            <div class="text-center mt-3">
                                @if(auth()->user()->isAdmin())
                                <a href="{{ route('admin.medicines.index') }}" class="btn btn-outline-success btn-sm">
                                    <i class="fas fa-cog me-1"></i>{{ __('app.manage_medicines') }}
                                </a>
                                @else
                                <a href="{{ route('transactions.create') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus me-1"></i>{{ __('app.dispense_medicine') }}
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Sidebar -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-3 bg-info bg-opacity-10 p-2">
                                <i class="fas fa-bolt text-info fs-5"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold">{{ __('app.quick_actions') }}</h6>
                            <small class="text-muted">{{ __('app.common_tasks') }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-3">
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>{{ __('app.new_transaction') }}
                        </a>
                        <a href="{{ route('patients.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-user-plus me-2"></i>{{ __('app.add_patient') }}
                        </a>
                        <a href="{{ route('patients.index') }}" class="btn btn-outline-info">
                            <i class="fas fa-search me-2"></i>{{ __('app.search_patient') }}
                        </a>
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-history me-2"></i>{{ __('app.transaction_history') }}
                        </a>
                        @if(auth()->user()->isAdmin())
                        <hr class="my-2">
                        <a href="{{ route('admin.medicines.create') }}" class="btn btn-outline-success">
                            <i class="fas fa-pills me-2"></i>{{ __('app.add_medicine') }}
                        </a>
                        <a href="{{ route('admin.services.create') }}" class="btn btn-outline-warning">
                            <i class="fas fa-stethoscope me-2"></i>{{ __('app.add_service') }}
                        </a>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-outline-danger">
                            <i class="fas fa-user-plus me-2"></i>{{ __('app.add_user') }}
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Patient Management & Output Section -->
    <div class="row g-4 mb-4">
        <!-- Pasien (Patient Search & Management) -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-info bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="rounded-3 bg-info bg-opacity-20 p-2">
                                    <i class="fas fa-users text-info fs-5"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-info">{{ __('app.patients') }}</h6>
                                <small class="text-muted">{{ __('app.patient_management') }}</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('patients.create') }}" class="btn btn-info btn-sm">
                                <i class="fas fa-user-plus me-1"></i>{{ __('app.add_patient') }}
                            </a>
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>{{ __('app.new_transaction') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Patient Search -->
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" 
                                       placeholder="{{ __('app.search_patient_placeholder') }}" 
                                       id="patientSearch">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button class="btn btn-outline-secondary w-100" onclick="searchPatients()">
                                <i class="fas fa-search me-1"></i>{{ __('app.search') }}
                            </button>
                        </div>
                    </div>

                    <!-- Recent Patients -->
                    <div class="patients-list">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="mb-0 fw-semibold">{{ __('app.recent_patients') }}</h6>
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-info btn-sm">
                                <i class="fas fa-list me-1"></i>{{ __('app.view_all') }}
                            </a>
                        </div>
                        
                        @php
                            $recent_patients = App\Models\Patient::latest()->take(5)->get();
                        @endphp
                        
                        @forelse($recent_patients as $patient)
                        <div class="d-flex justify-content-between align-items-center py-3 border-bottom">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-user text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-medium">{{ $patient->name }}</h6>
                                    <small class="text-muted">
                                        <i class="fas fa-phone me-1"></i>{{ $patient->phone ?? __('app.no_phone') }} | 
                                        <i class="fas fa-calendar me-1"></i>{{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->format('M j, Y') : __('app.no_dob') }}
                                    </small>
                                </div>
                            </div>
                            <div class="d-flex gap-1">
                                <a href="{{ route('patients.show', $patient) }}" 
                                   class="btn btn-outline-info btn-sm" title="{{ __('app.view_details') }}">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('transactions.create', ['patient_id' => $patient->id]) }}" 
                                   class="btn btn-primary btn-sm" title="{{ __('app.create_transaction') }}">
                                    <i class="fas fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted opacity-50 mb-3"></i>
                            <h6 class="text-muted mb-2">{{ __('app.no_patients_found') }}</h6>
                            <p class="text-muted mb-3">{{ __('app.start_by_adding_first_patient') }}</p>
                            <a href="{{ route('patients.create') }}" class="btn btn-info">
                                <i class="fas fa-user-plus me-1"></i>{{ __('app.add_patient') }}
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <!-- Output (Transaction Summary) -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-secondary bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <div class="rounded-3 bg-secondary bg-opacity-20 p-2">
                                <i class="fas fa-receipt text-secondary fs-5"></i>
                            </div>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-bold text-secondary">{{ __('app.output') }}</h6>
                            <small class="text-muted">{{ __('app.transaction_summary') }}</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @php
                        $today_transactions = App\Models\Transaction::whereDate('created_at', today())->latest()->take(3)->get();
                    @endphp
                    
                    @forelse($today_transactions as $transaction)
                    <div class="d-flex justify-content-between align-items-start py-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center mb-1">
                                <span class="fw-semibold text-dark">{{ $transaction->patient->name }}</span>
                                @if($transaction->is_paid)
                                    <span class="badge bg-success ms-2 px-2 py-1">{{ __('app.paid') }}</span>
                                @else
                                    <span class="badge bg-warning ms-2 px-2 py-1">{{ __('app.unpaid') }}</span>
                                @endif
                            </div>
                            <div class="mb-1">
                                <small class="text-success fw-bold">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</small>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $transaction->created_at->format('g:i A') }}</small>
                                <div class="d-flex gap-1">
                                    <a href="{{ route('transactions.show', $transaction) }}" 
                                       class="btn btn-outline-secondary btn-sm" title="{{ __('app.view') }}">
                                        <i class="fas fa-eye fa-xs"></i>
                                    </a>
                                    <a href="{{ route('transactions.print', $transaction) }}" 
                                       class="btn btn-outline-primary btn-sm" title="{{ __('app.print') }} {{ __('app.receipt') }}" target="_blank">
                                        <i class="fas fa-print fa-xs"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-4">
                        <i class="fas fa-receipt fa-2x text-muted opacity-50 mb-3"></i>
                        <p class="text-muted mb-0">{{ __('app.no_transactions_today') }}</p>
                    </div>
                    @endforelse
                    
                    <div class="text-center mt-3">
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-history me-1"></i>{{ __('app.view_all_transactions') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Transaksi Section -->
    <div class="row g-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-dark bg-opacity-10 border-0 py-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="me-3">
                                <div class="rounded-3 bg-dark bg-opacity-20 p-2">
                                    <i class="fas fa-history text-dark fs-5"></i>
                                </div>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold text-dark">{{ __('app.transaction_history') }}</h6>
                                <small class="text-muted">{{ __('app.all_completed_transactions') }}</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <div class="input-group" style="width: 300px;">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="fas fa-search text-muted"></i>
                                </span>
                                <input type="text" class="form-control border-start-0 ps-0" 
                                       placeholder="{{ __('app.search_transactions_placeholder') }}" 
                                       id="transactionSearch">
                            </div>
                            <a href="{{ route('transactions.index') }}" class="btn btn-outline-dark btn-sm">
                                <i class="fas fa-external-link-alt me-1"></i>{{ __('app.view_all') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($recent_transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold ps-4">{{ __('app.transaction_id') }}</th>
                                        <th class="border-0 fw-semibold">{{ __('app.patient') }}</th>
                                        <th class="border-0 fw-semibold">{{ __('app.services') }}</th>
                                        <th class="border-0 fw-semibold">{{ __('app.medicines') }}</th>
                                        <th class="border-0 fw-semibold">{{ __('app.amount') }}</th>
                                        <th class="border-0 fw-semibold">{{ __('app.status') }}</th>
                                        <th class="border-0 fw-semibold">{{ __('app.date') }}</th>
                                        <th class="border-0 fw-semibold pe-4">{{ __('app.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recent_transactions as $transaction)
                                    <tr class="align-middle">
                                        <td class="ps-4">
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-3 bg-primary bg-opacity-10 p-2 me-3">
                                                    <i class="fas fa-receipt text-primary fa-sm"></i>
                                                </div>
                                                <span class="fw-semibold text-primary">{{ $transaction->transaction_id }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="fw-medium">{{ $transaction->patient->name }}</span>
                                                <br>
                                                <small class="text-muted">{{ $transaction->patient->phone ?? __('app.no_phone') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            @if($transaction->services->count() > 0)
                                                @foreach($transaction->services as $service)
                                                    <small class="badge bg-info bg-opacity-20 text-info me-1 mb-1">{{ $service->name }}</small>
                                                @endforeach
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->medicines->count() > 0)
                                                @foreach($transaction->medicines as $medicine)
                                                    <small class="badge bg-success bg-opacity-20 text-success me-1 mb-1">
                                                        {{ $medicine->name }} ({{ $medicine->pivot->quantity }})
                                                    </small>
                                                @endforeach
                                            @else
                                                <small class="text-muted">-</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            @if($transaction->is_paid)
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>{{ __('app.paid') }}
                                                </span>
                                            @else
                                                <span class="badge bg-warning px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i>{{ __('app.pending') }}
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $transaction->created_at->format('M j, Y') }}</span>
                                            <br>
                                            <small class="text-muted">{{ $transaction->created_at->format('g:i A') }}</small>
                                        </td>
                                        <td class="pe-4">
                                            <div class="d-flex gap-1">
                                                <a href="{{ route('transactions.show', $transaction) }}" 
                                                   class="btn btn-outline-primary btn-sm" title="{{ __('app.view_details') }}">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('transactions.print', $transaction) }}" 
                                                   class="btn btn-outline-secondary btn-sm" title="{{ __('app.print') }} {{ __('app.receipt') }}" target="_blank">
                                                    <i class="fas fa-print"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <div class="mb-3">
                                <i class="fas fa-history fa-3x text-muted opacity-50"></i>
                            </div>
                            <h6 class="text-muted mb-2">{{ __('app.no_transaction_history') }}</h6>
                            <p class="text-muted mb-3">{{ __('app.start_first_transaction') }}</p>
                            <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>{{ __('app.create_transaction') }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function searchPatients() {
    const searchTerm = document.getElementById('patientSearch').value;
    if (searchTerm.trim()) {
        window.location.href = `{{ route('patients.index') }}?search=${encodeURIComponent(searchTerm)}`;
    }
}

function searchTransactions() {
    const searchTerm = document.getElementById('transactionSearch').value;
    if (searchTerm.trim()) {
        window.location.href = `{{ route('transactions.index') }}?search=${encodeURIComponent(searchTerm)}`;
    }
}

// Allow search on Enter key
document.getElementById('patientSearch')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchPatients();
    }
});

document.getElementById('transactionSearch')?.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        searchTransactions();
    }
});
</script>

<style>
/* Enhanced Styles for Modern Dashboard */
.stats-card {
    transition: all 0.3s ease;
    border-radius: 16px;
    overflow: hidden;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1) !important;
}

.stats-icon {
    width: 55px;
    height: 55px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.feature-card {
    transition: all 0.3s ease;
    border-radius: 12px;
}

.feature-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1) !important;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #42e695 100%);
}

.bg-gradient-warning {
    background: linear-gradient(135deg, #fdbb2d 0%, #22c1c3 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.03);
    transform: scale(1.01);
}

.card {
    transition: all 0.3s ease;
    border-radius: 12px;
    border: none;
}

.card:hover {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
}

.btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-1px);
}

.badge {
    border-radius: 6px;
    font-weight: 500;
}

.rounded-3 {
    border-radius: 12px !important;
}

.input-group-text {
    background: #f8f9fa;
    border: 1px solid #e9ecef;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Low Stock Alerts */
.medicines-list .badge.bg-danger {
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.7; }
    100% { opacity: 1; }
}

/* Responsive improvements */
@media (max-width: 768px) {
    .stats-card {
        margin-bottom: 1rem;
    }
    
    .card-body {
        padding: 1rem;
    }
    
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }
}

/* Enhanced table styling */
.table th {
    font-weight: 600;
    color: #495057;
    background: #f8f9fa;
}

.table td {
    vertical-align: middle;
    padding: 1rem 0.75rem;
}

/* Custom scrollbar */
.table-responsive::-webkit-scrollbar {
    height: 6px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1;
}
</style>
@endsection