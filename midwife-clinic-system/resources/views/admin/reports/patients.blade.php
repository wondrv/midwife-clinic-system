@extends('layouts.app')

@section('title', '- Patient Reports')

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="fas fa-users text-primary me-2"></i>Riwayat Pasien
                    </h1>
                    <p class="text-muted mb-0">Patient history and detailed information</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i>Add Patient
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-gradient-primary text-white">
                <div class="card-body text-center py-4">
                    <div class="mb-2">
                        <i class="fas fa-users fa-2x"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $stats['total_patients'] }}</h3>
                    <small>Total Patients</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-gradient-success text-white">
                <div class="card-body text-center py-4">
                    <div class="mb-2">
                        <i class="fas fa-user-check fa-2x"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $stats['patients_with_transactions'] }}</h3>
                    <small>Active Patients</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm bg-gradient-info text-white">
                <div class="card-body text-center py-4">
                    <div class="mb-2">
                        <i class="fas fa-calendar-plus fa-2x"></i>
                    </div>
                    <h3 class="fw-bold mb-1">{{ $stats['patients_this_month'] }}</h3>
                    <small>New This Month</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0 py-3">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-filter me-2"></i>Filter & Search
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.reports.patients') }}">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label small fw-medium">Search</label>
                        <input type="text" name="search" class="form-control" 
                               placeholder="Name, phone, or NIK..." 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Date From</label>
                        <input type="date" name="date_from" class="form-control" 
                               value="{{ request('date_from') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Date To</label>
                        <input type="date" name="date_to" class="form-control" 
                               value="{{ request('date_to') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Transaction Status</label>
                        <select name="transaction_status" class="form-select">
                            <option value="">All Patients</option>
                            <option value="has_transactions" {{ request('transaction_status') === 'has_transactions' ? 'selected' : '' }}>With Transactions</option>
                            <option value="no_transactions" {{ request('transaction_status') === 'no_transactions' ? 'selected' : '' }}>No Transactions</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Time Range</label>
                        <select name="transaction_period" class="form-select">
                            <option value="">All Time</option>
                            <option value="1_day" {{ request('transaction_period') === '1_day' ? 'selected' : '' }}>Last 1 Day</option>
                            <option value="1_week" {{ request('transaction_period') === '1_week' ? 'selected' : '' }}>Last 1 Week</option>
                            <option value="1_month" {{ request('transaction_period') === '1_month' ? 'selected' : '' }}>Last 1 Month</option>
                        </select>
                    </div>
                    <div class="col-md-1">
                        <label class="form-label small fw-medium">&nbsp;</label>
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="row g-3 mt-2">
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Min Amount</label>
                        <input type="number" name="amount_min" class="form-control" 
                               placeholder="0" value="{{ request('amount_min') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Max Amount</label>
                        <input type="number" name="amount_max" class="form-control" 
                               placeholder="1000000" value="{{ request('amount_max') }}">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Sort By</label>
                        <select name="sort" class="form-select">
                            <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>Name</option>
                            <option value="transactions_count" {{ request('sort') === 'transactions_count' ? 'selected' : '' }}>Transaction Count</option>
                            <option value="total_spent" {{ request('sort') === 'total_spent' ? 'selected' : '' }}>Total Spent</option>
                            <option value="last_visit" {{ request('sort') === 'last_visit' ? 'selected' : '' }}>Last Visit</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label small fw-medium">Order</label>
                        <select name="order" class="form-select">
                            <option value="asc" {{ request('order') === 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ request('order') === 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label small fw-medium">&nbsp;</label>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.reports.patients') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-refresh me-1"></i>Reset
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Patients Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">Patient Details</h6>
                <span class="text-muted small">{{ $patients->total() }} patients found</span>
            </div>
        </div>
        <div class="card-body p-0">
            @if($patients->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold ps-4">Patient</th>
                                <th class="border-0 fw-semibold">Contact</th>
                                <th class="border-0 fw-semibold">Registration</th>
                                <th class="border-0 fw-semibold">Transactions</th>
                                <th class="border-0 fw-semibold">Services Used</th>
                                <th class="border-0 fw-semibold">Medicines Used</th>
                                <th class="border-0 fw-semibold">Total Spent</th>
                                <th class="border-0 fw-semibold">Last Visit</th>
                                <th class="border-0 fw-semibold pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($patients as $patient)
                            @php
                                $totalSpent = $patient->transactions->sum('total_amount');
                                $transactionCount = $patient->transactions->count();
                                $lastTransaction = $patient->transactions->sortByDesc('created_at')->first();
                                $allServices = $patient->transactions->flatMap->services->unique('id');
                                $allMedicines = $patient->transactions->flatMap->medicines->unique('id');
                            @endphp
                            <tr class="align-middle">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-medium">{{ $patient->name }}</h6>
                                            <small class="text-muted">
                                                {{ $patient->date_of_birth ? \Carbon\Carbon::parse($patient->date_of_birth)->age . ' years old' : 'Age unknown' }}
                                            </small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="mb-1">
                                            <i class="fas fa-phone text-muted me-1"></i>
                                            <span class="small">{{ $patient->phone ?? 'No phone' }}</span>
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt text-muted me-1"></i>
                                            <span class="small">{{ Str::limit($patient->address ?? 'No address', 30) }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $patient->created_at->format('M j, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $patient->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div class="text-center">
                                        <span class="badge bg-info bg-opacity-20 text-info fs-6 px-3 py-2">
                                            {{ $transactionCount }}
                                        </span>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @forelse($allServices->take(3) as $service)
                                            <span class="badge bg-primary bg-opacity-20 text-primary">{{ $service->name }}</span>
                                        @empty
                                            <span class="text-muted small">-</span>
                                        @endforelse
                                        @if($allServices->count() > 3)
                                            <span class="badge bg-secondary">+{{ $allServices->count() - 3 }} more</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        @forelse($allMedicines->take(3) as $medicine)
                                            <span class="badge bg-success bg-opacity-20 text-success">{{ $medicine->name }}</span>
                                        @empty
                                            <span class="text-muted small">-</span>
                                        @endforelse
                                        @if($allMedicines->count() > 3)
                                            <span class="badge bg-secondary">+{{ $allMedicines->count() - 3 }} more</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">
                                        Rp {{ number_format($totalSpent, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td>
                                    @if($lastTransaction)
                                        <span class="text-muted">{{ $lastTransaction->created_at->format('M j, Y') }}</span>
                                        <br>
                                        <small class="text-muted">{{ $lastTransaction->created_at->diffForHumans() }}</small>
                                    @else
                                        <span class="text-muted">Never</span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('patients.show', $patient) }}" 
                                           class="btn btn-outline-primary btn-sm" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('patients.edit', $patient) }}" 
                                           class="btn btn-outline-secondary btn-sm" title="Edit Patient">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('transactions.create', ['patient_id' => $patient->id]) }}" 
                                           class="btn btn-outline-success btn-sm" title="New Transaction">
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
                <div class="card-footer bg-white border-0 py-3">
                    {{ $patients->links() }}
                </div>
            @else
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-users fa-3x text-muted opacity-50"></i>
                    </div>
                    <h6 class="text-muted mb-2">No Patients Found</h6>
                    <p class="text-muted mb-3">Try adjusting your search criteria</p>
                    <a href="{{ route('patients.create') }}" class="btn btn-primary">
                        <i class="fas fa-user-plus me-1"></i>Add First Patient
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.bg-gradient-success {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
}

.bg-gradient-info {
    background: linear-gradient(135deg, #667eea 0%, #42e695 100%);
}

.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.03);
}

.badge {
    font-size: 0.75rem;
}
</style>
@endsection
