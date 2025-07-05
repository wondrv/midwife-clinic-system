@extends('layouts.app')

@section('title', '- ' . __('app.medicine_management'))

@section('content')
<div class="container-fluid px-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="h3 mb-1 text-dark fw-bold">
                        <i class="fas fa-pills text-success me-2"></i>{{ __('app.medicine_management') }}
                    </h1>
                    <p class="text-muted mb-0">{{ __('app.manage_medicine_inventory') }}</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.medicines.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>{{ __('app.add_medicine') }}
                    </a>
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>{{ __('app.back') }}
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-header bg-light border-0 py-3">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="fas fa-search me-2"></i>{{ __('app.search_and_filter') }}
            </h6>
        </div>
        <div class="card-body">
            <form method="GET" action="{{ route('admin.medicines.index') }}">
                <div class="row g-3">
                    <div class="col-md-4">
                        <input type="text" name="search" class="form-control" 
                               placeholder="{{ __('app.search_medicine_name') }}" 
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <select name="stock_status" class="form-select">
                            <option value="">{{ __('app.all_stock') }}</option>
                            <option value="low" {{ request('stock_status') === 'low' ? 'selected' : '' }}>{{ __('app.low_stock') }} (≤5)</option>
                            <option value="out" {{ request('stock_status') === 'out' ? 'selected' : '' }}>{{ __('app.out_of_stock') }}</option>
                            <option value="normal" {{ request('stock_status') === 'normal' ? 'selected' : '' }}>{{ __('app.normal_stock') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="sort" class="form-select">
                            <option value="name" {{ request('sort') === 'name' ? 'selected' : '' }}>{{ __('app.sort_by_name') }}</option>
                            <option value="stock" {{ request('sort') === 'stock' ? 'selected' : '' }}>{{ __('app.sort_by_stock') }}</option>
                            <option value="profit" {{ request('sort') === 'profit' ? 'selected' : '' }}>{{ __('app.sort_by_profit') }}</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="fas fa-search me-1"></i>{{ __('app.search') }}
                        </button>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('admin.medicines.index') }}" class="btn btn-outline-secondary w-100">
                            <i class="fas fa-refresh me-1"></i>{{ __('app.reset') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Medicines Table -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-bold">{{ __('app.medicine_inventory') }}</h6>
                <span class="text-muted small">{{ $medicines->count() }} {{ __('app.medicines') }}</span>
            </div>
        </div>
        <div class="card-body p-0">
            @forelse($medicines as $medicine)
                @if($loop->first)
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold ps-4">{{ __('app.medicine') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.stock_status') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.pricing') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.profit_analysis') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.status') }}</th>
                                <th class="border-0 fw-semibold pe-4">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                @endif
                            <tr class="align-middle {{ $medicine->stock <= 5 ? 'table-warning' : '' }}">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-3 bg-success bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-pills text-success"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-medium">{{ $medicine->name }}</h6>
                                            <small class="text-muted">ID: {{ $medicine->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            @if($medicine->stock <= 0)
                                                <span class="badge bg-danger px-3 py-2">
                                                    <i class="fas fa-times-circle me-1"></i>{{ __('app.out_of_stock') }}
                                                </span>
                                            @elseif($medicine->stock <= 5)
                                                <span class="badge bg-warning px-3 py-2">
                                                    <i class="fas fa-exclamation-triangle me-1"></i>{{ __('app.low_stock') }}
                                                </span>
                                            @else
                                                <span class="badge bg-success px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>{{ __('app.in_stock') }}
                                                </span>
                                            @endif
                                        </div>
                                        <div>
                                            <span class="fw-bold fs-5 {{ $medicine->stock <= 5 ? 'text-danger' : 'text-success' }}">
                                                {{ $medicine->stock }}
                                            </span>
                                            <br>
                                            <small class="text-muted">{{ __('app.units') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="mb-1">
                                            <span class="text-muted small">{{ __('app.base') }}:</span>
                                            <span class="fw-medium">Rp {{ number_format($medicine->base_price, 0, ',', '.') }}</span>
                                        </div>
                                        <div>
                                            <span class="text-muted small">{{ __('app.selling') }}:</span>
                                            <span class="fw-bold text-success">Rp {{ number_format($medicine->selling_price, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div class="mb-1">
                                            <span class="text-muted small">Profit:</span>
                                            <span class="fw-bold text-primary">Rp {{ number_format($medicine->profit, 0, ',', '.') }}</span>
                                        </div>
                                        <div>
                                            <span class="text-muted small">Margin:</span>
                                            <span class="fw-medium text-info">{{ number_format($medicine->profit_percentage, 1) }}%</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if($medicine->is_active)
                                        <span class="badge bg-success bg-opacity-20 text-success">
                                            <i class="fas fa-check me-1"></i>Active
                                        </span>
                                    @else
                                        <span class="badge bg-secondary bg-opacity-20 text-secondary">
                                            <i class="fas fa-pause me-1"></i>Inactive
                                        </span>
                                    @endif
                                </td>
                                <td class="pe-4">
                                    <div class="d-flex gap-1">
                                        <a href="{{ route('admin.medicines.edit', $medicine) }}" 
                                           class="btn btn-outline-primary btn-sm" title="Edit Medicine">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        @if($medicine->stock <= 5)
                                        <button class="btn btn-outline-warning btn-sm" 
                                                title="Restock Alert" disabled>
                                            <i class="fas fa-exclamation-triangle"></i>
                                        </button>
                                        @endif
                                        <form action="{{ route('admin.medicines.destroy', $medicine) }}" 
                                              method="POST" class="d-inline" 
                                              onsubmit="return confirm('Are you sure you want to delete this medicine?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                @if($loop->last)
                        </tbody>
                    </table>
                </div>
                @endif
            @empty
                <div class="text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-pills fa-3x text-muted opacity-50"></i>
                    </div>
                    <h6 class="text-muted mb-2">No Medicines Found</h6>
                    <p class="text-muted mb-3">Start by adding your first medicine to the inventory</p>
                    <a href="{{ route('admin.medicines.create') }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>Add Medicine
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>

<style>
.table-hover tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.03);
}

.badge {
    font-weight: 500;
    border-radius: 6px;
}

.table-warning {
    --bs-table-bg: rgba(255, 193, 7, 0.1);
}
</style>
@endsection
