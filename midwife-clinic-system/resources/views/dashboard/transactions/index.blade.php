@extends('layouts.app')

@section('title', '- ' . __('app.transactions'))

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-receipt text-primary me-2"></i>{{ __('app.transaction_management') }}
                    </h1>
                    <p class="text-muted mb-0">{{ __('app.manage_track_transactions') }}</p>
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

    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm bg-primary bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-primary bg-opacity-20 p-3">
                            <i class="fas fa-receipt text-primary fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-primary mb-1">{{ $transactions->total() }}</h4>
                    <small class="text-muted">{{ __('app.total_transactions') }}</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm bg-success bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-success bg-opacity-20 p-3">
                            <i class="fas fa-check-circle text-success fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-success mb-1">{{ $transactions->where('is_paid', true)->count() }}</h4>
                    <small class="text-muted">{{ __('app.paid_transactions') }}</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm bg-warning bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-warning bg-opacity-20 p-3">
                            <i class="fas fa-clock text-warning fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-warning mb-1">{{ $transactions->where('is_paid', false)->count() }}</h4>
                    <small class="text-muted">{{ __('app.pending_payments') }}</small>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="card border-0 shadow-sm bg-info bg-opacity-10">
                <div class="card-body text-center">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <div class="rounded-circle bg-info bg-opacity-20 p-3">
                            <i class="fas fa-money-bill-wave text-info fa-lg"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-info mb-1">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</h4>
                    <small class="text-muted">{{ __('app.total_revenue') }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Card -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-0 py-3">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <h5 class="mb-0 fw-bold">
                        <i class="fas fa-list text-primary me-2"></i>{{ __('app.transaction_records') }}
                    </h5>
                </div>
                <div class="col-md-8">
                    <!-- Enhanced Search and Filter Form -->
                    <form method="GET" class="d-flex gap-2">
                        <div class="input-group flex-grow-1">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" 
                                   name="search" 
                                   class="form-control border-start-0" 
                                   placeholder="{{ __('app.search_transactions') }}" 
                                   value="{{ request('search') }}"
                                   autocomplete="off">
                        </div>
                        <select name="status" class="form-select" style="max-width: 150px;">
                            <option value="">{{ __('app.all_status') }}</option>
                            <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>{{ __('app.paid') }}</option>
                            <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>{{ __('app.unpaid') }}</option>
                        </select>
                        @if(request()->hasAny(['search', 'status']))
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary" title="{{ __('app.clear_filters') }}">
                            <i class="fas fa-times"></i>
                        </a>
                        @endif
                        <button class="btn btn-primary" type="submit">{{ __('app.search') }}</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-body p-0">
            @if($transactions->count() > 0)
                <!-- Responsive Transactions Table -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="border-0 fw-semibold ps-4">{{ __('app.transaction') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.patient') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.date') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.amount') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.status') }}</th>
                                <th class="border-0 fw-semibold">{{ __('app.staff') }}</th>
                                <th class="border-0 fw-semibold pe-4 text-center">{{ __('app.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transactions as $transaction)
                            <tr class="align-middle">
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-receipt text-primary fa-sm"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold text-primary">{{ $transaction->transaction_id }}</span>
                                            <br>
                                            <small class="text-muted">{{ $transaction->created_at->format('g:i A') }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <h6 class="mb-0 fw-semibold">{{ $transaction->patient->name }}</h6>
                                        <small class="text-muted">{{ $transaction->patient->nik }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $transaction->created_at->format('M j, Y') }}</span>
                                    <br>
                                    <small class="text-muted">{{ $transaction->created_at->diffForHumans() }}</small>
                                </td>
                                <td>
                                    <div>
                                        <span class="fw-bold text-success h6 mb-0">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                        @if($transaction->total_profit > 0)
                                            <br>
                                            <small class="text-info">{{ __('app.profit') }}: Rp {{ number_format($transaction->total_profit, 0, ',', '.') }}</small>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    @if($transaction->is_paid)
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                            <i class="fas fa-check-circle me-1"></i>{{ __('app.paid') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2">
                                            <i class="fas fa-clock me-1"></i>{{ __('app.pending') }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle bg-secondary bg-opacity-10 p-1 me-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-user text-secondary fa-sm d-flex align-items-center justify-content-center h-100"></i>
                                        </div>
                                        <span class="text-muted small">{{ $transaction->user->name }}</span>
                                    </div>
                                </td>
                                <td class="pe-4 text-center">
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('transactions.show', $transaction) }}" 
                                           class="btn btn-outline-primary btn-sm" 
                                           title="{{ __('app.view_details') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        @if(!$transaction->is_paid)
                                        <button type="button" 
                                                class="btn btn-outline-success btn-sm" 
                                                onclick="markAsPaid({{ $transaction->id }})"
                                                title="{{ __('app.mark_as_paid') }}">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        @endif
                                        <button type="button" 
                                                class="btn btn-outline-info btn-sm" 
                                                onclick="printTransaction({{ $transaction->id }})"
                                                title="{{ __('app.print_receipt') }}">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($transactions->hasPages())
                <div class="card-footer bg-light border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="text-muted">
                            {{ __('app.showing') }} {{ $transactions->firstItem() }} {{ __('app.to') }} {{ $transactions->lastItem() }} {{ __('app.of') }} {{ $transactions->total() }} {{ __('app.transactions') }}
                        </div>
                        <div>
                            {{ $transactions->links() }}
                        </div>
                    </div>
                </div>
                @endif
            @else
                <!-- Empty State -->
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-receipt fa-4x text-muted opacity-50"></i>
                    </div>
                    @if(request()->hasAny(['search', 'status']))
                        <h5 class="text-muted mb-2">{{ __('app.no_transactions_found') }}</h5>
                        <p class="text-muted mb-3">{{ __('app.no_transactions_match_criteria') }}</p>
                        <a href="{{ route('transactions.index') }}" class="btn btn-outline-primary me-2">
                            <i class="fas fa-arrow-left me-1"></i>{{ __('app.view_all_transactions') }}
                        </a>
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>{{ __('app.new_transaction') }}
                        </a>
                    @else
                        <h5 class="text-muted mb-2">{{ __('app.no_transactions_yet') }}</h5>
                        <p class="text-muted mb-3">{{ __('app.start_first_transaction') }}</p>
                        <a href="{{ route('transactions.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-1"></i>{{ __('app.create_first_transaction') }}
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Mark as Paid Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h6 class="modal-title fw-bold">{{ __('app.confirm_payment') }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <i class="fas fa-check-circle fa-3x text-success"></i>
                </div>
                <p class="mb-0">{{ __('app.mark_transaction_paid') }}</p>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('app.cancel') }}</button>
                <button type="button" class="btn btn-success" id="confirmPayment">
                    <i class="fas fa-check me-1"></i>{{ __('app.mark_as_paid') }}
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let currentTransactionId = null;

function markAsPaid(transactionId) {
    currentTransactionId = transactionId;
    const modal = new bootstrap.Modal(document.getElementById('paymentModal'));
    modal.show();
}

document.getElementById('confirmPayment').addEventListener('click', function() {
    if (currentTransactionId) {
        // Create form to mark as paid
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/transactions/${currentTransactionId}/mark-paid`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PATCH';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
});

function printTransaction(transactionId) {
    // Open print view in new window
    window.open(`/transactions/${transactionId}/print`, '_blank');
}

// Auto-refresh every 30 seconds for live updates
setInterval(function() {
    if (!document.hidden) {
        // Only refresh if no modal is open and no form is being filled
        const openModals = document.querySelectorAll('.modal.show');
        const activeInputs = document.querySelectorAll('input:focus, textarea:focus, select:focus');
        
        if (openModals.length === 0 && activeInputs.length === 0) {
            location.reload();
        }
    }
}, 30000);
</script>
@endsection