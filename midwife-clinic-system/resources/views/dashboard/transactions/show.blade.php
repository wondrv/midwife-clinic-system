@extends('layouts.app')

@section('title', '- Transaction Details')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-receipt text-primary me-2"></i>Transaction Details
                    </h1>
                    <p class="text-muted mb-0">Complete transaction information and receipt</p>
                </div>
                <div class="d-flex gap-2">
                    @if(!$transaction->is_paid)
                    <button type="button" 
                            class="btn btn-success" 
                            onclick="markAsPaid({{ $transaction->id }})">
                        <i class="fas fa-check me-1"></i>Mark as Paid
                    </button>
                    @endif
                    <a href="{{ route('transactions.print', $transaction) }}" 
                       class="btn btn-outline-primary" 
                       target="_blank">
                        <i class="fas fa-print me-1"></i>Print Receipt
                    </a>
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <!-- Transaction Summary -->
        <div class="col-xl-4 col-lg-5">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                    <div class="d-flex align-items-center">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 me-3">
                            <i class="fas fa-file-invoice text-primary fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="mb-0 fw-bold">Transaction Summary</h5>
                            <small class="text-muted">Overview and payment status</small>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Transaction Status -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            @if($transaction->is_paid)
                                <div class="rounded-circle bg-success bg-opacity-10 p-4 d-inline-flex">
                                    <i class="fas fa-check-circle text-success fa-2x"></i>
                                </div>
                            @else
                                <div class="rounded-circle bg-warning bg-opacity-10 p-4 d-inline-flex">
                                    <i class="fas fa-clock text-warning fa-2x"></i>
                                </div>
                            @endif
                        </div>
                        <h4 class="fw-bold mb-1">{{ $transaction->transaction_id }}</h4>
                        @if($transaction->is_paid)
                            <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                <i class="fas fa-check-circle me-1"></i>Payment Completed
                            </span>
                        @else
                            <span class="badge bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25 px-3 py-2">
                                <i class="fas fa-clock me-1"></i>Payment Pending
                            </span>
                        @endif
                    </div>

                    <!-- Transaction Details -->
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Transaction Date</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $transaction->created_at->format('l, F j, Y') }}</p>
                                <small class="text-muted">{{ $transaction->created_at->format('g:i A') }}</small>
                            </div>
                        </div>

                        @if($transaction->is_paid && $transaction->paid_at)
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-check-circle text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Payment Date</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $transaction->paid_at->format('l, F j, Y') }}</p>
                                <small class="text-muted">{{ $transaction->paid_at->format('g:i A') }}</small>
                            </div>
                        </div>
                        @endif

                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user-md text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Created By</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $transaction->user->name }}</p>
                                <small class="text-muted">{{ $transaction->user->email }}</small>
                            </div>
                        </div>

                        @if($transaction->notes)
                        <div class="col-12">
                            <div class="p-3 bg-light rounded">
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-sticky-note text-primary me-2"></i>
                                    <small class="text-muted text-uppercase fw-bold">Notes</small>
                                </div>
                                <p class="mb-0 fw-semibold">{{ $transaction->notes }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Amount Summary -->
                    <div class="mt-4 pt-3 border-top">
                        <div class="text-center">
                            <h6 class="text-muted mb-2">Total Amount</h6>
                            <h3 class="fw-bold text-success mb-0">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patient & Services Details -->
        <div class="col-xl-8 col-lg-7">
            <div class="row g-4">
                <!-- Patient Information -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-user text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Patient Information</h6>
                                    <small class="text-muted">Patient details for this transaction</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-user text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $transaction->patient->name }}</h6>
                                            <small class="text-muted">Patient Name</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-id-card text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold font-monospace">{{ $transaction->patient->nik }}</h6>
                                            <small class="text-muted">NIK</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-phone text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $transaction->patient->phone }}</h6>
                                            <small class="text-muted">Phone Number</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-center p-3 bg-light rounded">
                                        <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                            <i class="fas fa-birthday-cake text-primary"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $transaction->patient->age }} years old</h6>
                                            <small class="text-muted">Age</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('patients.show', $transaction->patient) }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-eye me-1"></i>View Patient Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services & Medicines -->
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-white border-0 py-3">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-list text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Services & Medicines</h6>
                                    <small class="text-muted">Items included in this transaction</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th class="border-0 fw-semibold ps-4">Item</th>
                                            <th class="border-0 fw-semibold">Type</th>
                                            <th class="border-0 fw-semibold">Quantity</th>
                                            <th class="border-0 fw-semibold">Price</th>
                                            <th class="border-0 fw-semibold pe-4">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($transaction->services as $service)
                                        <tr class="align-middle">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                                        <i class="fas fa-stethoscope text-info fa-sm"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-semibold">{{ $service->name }}</span>
                                                        @if($service->description)
                                                            <br>
                                                            <small class="text-muted">{{ $service->description }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info bg-opacity-10 text-info border border-info border-opacity-25">
                                                    Service
                                                </span>
                                            </td>
                                            <td>1</td>
                                            <td>Rp {{ number_format($service->price, 0, ',', '.') }}</td>
                                            <td class="pe-4">
                                                <span class="fw-bold text-success">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                            </td>
                                        </tr>
                                        @endforeach

                                        @foreach($transaction->medicines as $medicine)
                                        <tr class="align-middle">
                                            <td class="ps-4">
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                                        <i class="fas fa-pills text-success fa-sm"></i>
                                                    </div>
                                                    <div>
                                                        <span class="fw-semibold">{{ $medicine->name }}</span>
                                                        @if($medicine->description)
                                                            <br>
                                                            <small class="text-muted">{{ $medicine->description }}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25">
                                                    Medicine
                                                </span>
                                            </td>
                                            <td>{{ $medicine->pivot->quantity }}</td>
                                            <td>Rp {{ number_format($medicine->price, 0, ',', '.') }}</td>
                                            <td class="pe-4">
                                                <span class="fw-bold text-success">Rp {{ number_format($medicine->price * $medicine->pivot->quantity, 0, ',', '.') }}</span>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot class="table-light">
                                        <tr>
                                            <th colspan="4" class="ps-4 text-end">Total Amount:</th>
                                            <th class="pe-4">
                                                <span class="h5 fw-bold text-success mb-0">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
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
