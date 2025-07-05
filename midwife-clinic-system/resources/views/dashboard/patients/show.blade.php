@extends('layouts.app')

@section('title', '- Patient Details')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-user text-primary me-2"></i>Patient Profile
                    </h1>
                    <p class="text-muted mb-0">Complete patient information and transaction history</p>
                </div>
                <div class="d-flex gap-2">
                    <a href="{{ route('transactions.create', ['patient_id' => $patient->id]) }}" class="btn btn-success">
                        <i class="fas fa-plus me-1"></i>New Transaction
                    </a>
                    <a href="{{ route('patients.edit', $patient) }}" class="btn btn-warning">
                        <i class="fas fa-edit me-1"></i>Edit Patient
                    </a>
                    <a href="{{ route('patients.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Patient Information -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-user text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Patient Information</h5>
                            <small class="text-muted">Personal details</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center mb-4">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-4 d-inline-flex mb-3">
                            <i class="fas fa-user text-primary fa-3x"></i>
                        </div>
                        <h4 class="fw-bold text-dark mb-1">{{ $patient->name }}</h4>
                        <p class="text-muted mb-0">Patient ID: {{ $patient->id }}</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-id-card text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">NIK</small>
                                </div>
                                <p class="mb-0 fw-semibold font-monospace">{{ $patient->nik }}</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-birthday-cake text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Age</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $patient->age }} years</p>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Registered</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $patient->created_at->format('M j, Y') }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Birth Place</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $patient->place_of_birth }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-phone text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Contact</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $patient->phone }}</p>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-home text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Address</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $patient->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card border-0 shadow-sm mt-4">
                <div class="card-header bg-white border-0 py-3">
                    <h6 class="mb-0 fw-bold">
                        <i class="fas fa-chart-bar text-primary me-2"></i>Transaction Summary
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="p-3 bg-success bg-opacity-10 rounded">
                                <h5 class="fw-bold text-success mb-1">{{ $transactions->where('is_paid', true)->count() }}</h5>
                                <small class="text-muted">Paid</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-warning bg-opacity-10 rounded">
                                <h5 class="fw-bold text-warning mb-1">{{ $transactions->where('is_paid', false)->count() }}</h5>
                                <small class="text-muted">Pending</small>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="p-3 bg-primary bg-opacity-10 rounded">
                                <h5 class="fw-bold text-primary mb-1">Rp {{ number_format($transactions->sum('total_amount'), 0, ',', '.') }}</h5>
                                <small class="text-muted">Total Amount</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Transaction History -->
        <div class="col-xl-8 col-lg-7">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                <i class="fas fa-history text-info"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">Transaction History</h5>
                                <small class="text-muted">All patient transactions</small>
                            </div>
                        </div>
                        <a href="{{ route('transactions.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus me-1"></i>New Transaction
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    @if($transactions->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="border-0 fw-semibold ps-4">Transaction</th>
                                        <th class="border-0 fw-semibold">Amount</th>
                                        <th class="border-0 fw-semibold">Status</th>
                                        <th class="border-0 fw-semibold">Date</th>
                                        <th class="border-0 fw-semibold pe-4 text-center">Actions</th>
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
                                                    <small class="text-muted">by {{ $transaction->user->name }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                            @if($transaction->notes)
                                                <br>
                                                <small class="text-muted">{{ Str::limit($transaction->notes, 30) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($transaction->is_paid)
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                                    <i class="fas fa-check-circle me-1"></i>Paid
                                                </span>
                                            @else
                                                <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2">
                                                    <i class="fas fa-clock me-1"></i>Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $transaction->created_at->format('M j, Y') }}</span>
                                            <br>
                                            <small class="text-muted">{{ $transaction->created_at->format('g:i A') }}</small>
                                        </td>
                                        <td class="pe-4 text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('transactions.show', $transaction) }}" 
                                                   class="btn btn-outline-primary btn-sm" 
                                                   title="View Details">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                @if(!$transaction->is_paid)
                                                <button type="button" 
                                                        class="btn btn-outline-success btn-sm" 
                                                        onclick="markAsPaid({{ $transaction->id }})"
                                                        title="Mark as Paid">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                                @endif
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
                                    Showing {{ $transactions->firstItem() }} to {{ $transactions->lastItem() }} of {{ $transactions->total() }} transactions
                                </div>
                                <div>
                                    {{ $transactions->links() }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @else
                        <!-- No Transactions -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <i class="fas fa-receipt fa-4x text-muted opacity-50"></i>
                            </div>
                            <h6 class="text-muted mb-2">No Transaction History</h6>
                            <p class="text-muted mb-3">This patient has no transactions yet</p>
                            <a href="{{ route('transactions.create', ['patient_id' => $patient->id]) }}" class="btn btn-primary">
                                <i class="fas fa-plus me-1"></i>Create First Transaction
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function markAsPaid(transactionId) {
    if (confirm('Are you sure you want to mark this transaction as paid?')) {
        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/transactions/${transactionId}/mark-paid`;
        
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'PATCH';
        
        form.appendChild(csrfToken);
        form.appendChild(methodField);
        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endsection