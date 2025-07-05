@extends('layouts.app')

@section('title', '- ' . __('app.patients'))

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-users text-primary me-2"></i>{{ __('app.patient_management') }}
                    </h1>
                    <p class="text-muted mb-0">{{ __('app.manage_patient_records') }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i>{{ __('app.add_patient') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-primary bg-opacity-20 p-3">
                            <i class="fas fa-users text-primary fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-primary mb-1">{{ $patients->total() }}</h4>
                    <small class="text-muted">{{ __('app.total_patients') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-success bg-opacity-20 p-3">
                            <i class="fas fa-user-check text-success fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-success mb-1">{{ $patients->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                    <small class="text-muted">{{ __('app.new_this_month') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-info bg-opacity-20 p-3">
                            <i class="fas fa-user-clock text-info fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-info mb-1">{{ $patients->where('created_at', '>=', now()->startOfDay())->count() }}</h4>
                    <small class="text-muted">{{ __('app.added_today') }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-warning bg-opacity-20 p-3">
                            <i class="fas fa-search text-warning fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-warning mb-1">{{ request('search') ? $patients->count() : 0 }}</h4>
                    <small class="text-muted">{{ __('app.search_results') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>{{ __('app.patient_records') }}
                    </h5>
                </div>
                <div class="col-md-6">
                    <!-- Enhanced Search Form -->
                    <form method="GET" class="d-flex">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control border-start-0" 
                                   placeholder="{{ __('app.search_by_name_nik_phone') }}" 
                                   value="{{ request('search') }}"
                                   autocomplete="off">
                            @if(request('search'))
                            <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary" title="{{ __('app.clear_search') }}">
                                <i class="fas fa-times"></i>
                            </a>
                            @endif
                            <button class="btn btn-primary" type="submit">{{ __('app.search') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($patients->count() > 0)
                <!-- Responsive Patients Table -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold ps-4">{{ __('app.patient') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.nik') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.age') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.contact') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.location') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.registered') }}</th>
                                <th class="border-0 fw-semibold pe-4 text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            <tr class="align-middle">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $patient->name }}</h6>
                                            <small class="text-muted">
                                                {{ $patient->place_of_birth }}, {{ $patient->date_of_birth->format('Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="font-monospace text-muted">{{ $patient->nik }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25 px-2 py-1">
                                        {{ $patient->age }} {{ __('app.years_old') }}
                                    </span>
                                </td>
                                <td>
                                    <div>
                                        <i class="fas fa-phone text-muted me-1"></i>
                                        <span>{{ $patient->phone }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                        <span class="text-truncate" style="max-width: 150px;" title="{{ $patient->address }}">
                                            {{ Str::limit($patient->address, 30) }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $patient->created_at->format('M j, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $patient->created_at->diffForHumans() }}</small>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('patients.show', $patient) }}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           title="{{ __('app.view_details') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('patients.edit', $patient) }}" 
                                           class="btn btn-outline-warning btn-sm" 
                                           title="{{ __('app.edit_patient') }}">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('transactions.create', ['patient_id' => $patient->id]) }}" 
                                           class="btn btn-outline-success btn-sm" 
                                           title="{{ __('app.new_transaction') }}">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($patients->hasPages())
                <div class="card-footer bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            {{ __('app.showing') }} {{ $patients->firstItem() }} {{ __('app.to') }} {{ $patients->lastItem() }} {{ __('app.of') }} {{ $patients->total() }} {{ __('app.patients') }}
                        </div>
                        <div>
                            {{ $patients->links() }}
                        </div>
                    </div>
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-users fa-4x text-muted opacity-50"></i>
                    </div>
                    @if(request('search'))
                        <h5 class="text-muted mb-2">{{ __('app.no_patients_found') }}</h5>
                        <p class="text-muted mb-3">{{ __('app.no_patients_match_search') }} "{{ request('search') }}"</p>
                        <a href="{{ route('patients.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-arrow-left me-1"></i>{{ __('app.view_all_patients') }}
                        </a>
                        <a href="{{ route('patients.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i>{{ __('app.add_new_patient') }}
                        </a>
                    @else
                        <h5 class="text-muted mb-2">{{ __('app.no_patients_registered') }}</h5>
                        <p class="text-muted mb-3">{{ __('app.start_by_adding_first_patient') }}</p>
                        <a href="{{ route('patients.create') }}" class="btn btn-primary">
                            <i class="fas fa-user-plus me-1"></i>{{ __('app.add_first_patient') }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
@endsection