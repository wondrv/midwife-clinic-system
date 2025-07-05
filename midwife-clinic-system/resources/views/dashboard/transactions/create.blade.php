@extends('layouts.app')

@section('title', '- New Transaction')

@section('content')
<div class="container-fluid px-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col">
            <div class="d-flex justify-content-between align-items-center flex-wrap">
                <div>
                    <h1 class="h2 mb-1 text-dark fw-bold">
                        <i class="fas fa-receipt text-primary me-2"></i>New Transaction
                    </h1>
                    <p class="text-muted mb-0">Create a new patient transaction</p>
                </div>
                <div>
                    <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-arrow-left me-1"></i>Back to Transactions
                    </a>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST" id="transactionForm">
        @csrf
        
        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Patient Information Card -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary bg-opacity-10 p-2 me-3">
                                <i class="fas fa-user text-primary"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">Patient Information</h6>
                                <small class="text-muted">Select patient and add notes</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-8">
                                <label for="patient_id" class="form-label fw-semibold">
                                    Select Patient <span class="text-danger">*</span>
                                </label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light">
                                        <i class="fas fa-search text-muted"></i>
                                    </span>
                                    <select class="form-select @error('patient_id') is-invalid @enderror" 
                                            id="patient_id" 
                                            name="patient_id" 
                                            required>
                                        <option value="">Choose Patient...</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}" 
                                                    {{ (old('patient_id') ?? request('patient_id')) == $patient->id ? 'selected' : '' }}
                                                    data-name="{{ $patient->name }}"
                                                    data-nik="{{ $patient->nik }}"
                                                    data-phone="{{ $patient->phone }}">
                                                {{ $patient->name }} - {{ $patient->nik }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('patient_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div id="patientInfo" class="mt-2" style="display: none;">
                                    <div class="bg-light rounded p-3">
                                        <div class="row text-sm">
                                            <div class="col-6">
                                                <strong>Name:</strong> <span id="patientName"></span>
                                            </div>
                                            <div class="col-6">
                                                <strong>NIK:</strong> <span id="patientNik"></span>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <strong>Phone:</strong> <span id="patientPhone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="notes" class="form-label fw-semibold">Notes</label>
                                <textarea class="form-control" 
                                          id="notes" 
                                          name="notes" 
                                          rows="4" 
                                          placeholder="Optional notes or remarks">{{ old('notes') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Services Selection -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-success bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-stethoscope text-success"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Medical Services</h6>
                                    <small class="text-muted">Select applicable services</small>
                                </div>
                            </div>
                            <span class="badge bg-primary" id="servicesCount">0 selected</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($services->count() > 0)
                            <div class="row g-3">
                                @foreach($services as $service)
                                    <div class="col-lg-6">
                                        <div class="service-item border rounded p-3 h-100">
                                            <div class="form-check h-100 d-flex align-items-center">
                                                <input class="form-check-input service-checkbox me-3" 
                                                       type="checkbox" 
                                                       name="services[]" 
                                                       value="{{ $service->id }}" 
                                                       id="service{{ $service->id }}"
                                                       data-price="{{ $service->price }}">
                                                <label class="form-check-label flex-grow-1" for="service{{ $service->id }}">
                                                    <div class="d-flex justify-content-between align-items-start">
                                                        <div>
                                                            <h6 class="mb-1 fw-semibold">{{ $service->name }}</h6>
                                                            @if($service->description)
                                                                <p class="text-muted small mb-2">{{ Str::limit($service->description, 60) }}</p>
                                                            @endif
                                                        </div>
                                                        <div class="text-end">
                                                            <span class="fw-bold text-success">Rp {{ number_format($service->price, 0, ',', '.') }}</span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-stethoscope fa-3x text-muted opacity-50 mb-3"></i>
                                <h6 class="text-muted">No services available</h6>
                                <p class="text-muted mb-0">Please contact admin to add services</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Medicines Selection -->
                <div class="card border-0 shadow-sm">
                    <div class="card-header bg-white border-0 py-3">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <div class="rounded-circle bg-info bg-opacity-10 p-2 me-3">
                                    <i class="fas fa-pills text-info"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-bold">Medicines</h6>
                                    <small class="text-muted">Select medicines and quantities</small>
                                </div>
                            </div>
                            <span class="badge bg-primary" id="medicinesCount">0 selected</span>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($medicines->count() > 0)
                            <div id="medicinesContainer">
                                @foreach($medicines as $medicine)
                                    <div class="medicine-row border rounded p-3 mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-5">
                                                <div class="form-check">
                                                    <input class="form-check-input medicine-checkbox" 
                                                           type="checkbox" 
                                                           id="medicine{{ $medicine->id }}"
                                                           data-medicine-id="{{ $medicine->id }}"
                                                           data-price="{{ $medicine->selling_price }}"
                                                           data-stock="{{ $medicine->stock }}">
                                                    <label class="form-check-label" for="medicine{{ $medicine->id }}">
                                                        <h6 class="mb-1 fw-semibold">{{ $medicine->name }}</h6>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <span class="badge bg-info bg-opacity-10 text-info">
                                                                Stock: {{ $medicine->stock }}
                                                            </span>
                                                            <span class="badge bg-success bg-opacity-10 text-success">
                                                                Rp {{ number_format($medicine->selling_price, 0, ',', '.') }}
                                                            </span>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label small fw-semibold">Quantity</label>
                                                <div class="input-group">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="changeQuantity({{ $medicine->id }}, -1)">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                    <input type="number" 
                                                           class="form-control medicine-quantity text-center" 
                                                           placeholder="0" 
                                                           min="1" 
                                                           max="{{ $medicine->stock }}" 
                                                           disabled
                                                           data-medicine-id="{{ $medicine->id }}">
                                                    <button class="btn btn-outline-secondary btn-sm" type="button" onclick="changeQuantity({{ $medicine->id }}, 1)">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="col-md-4 text-end">
                                                <label class="form-label small fw-semibold">Total</label>
                                                <div class="h5 mb-0 fw-bold text-success medicine-total" data-medicine-id="{{ $medicine->id }}">Rp 0</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-4">
                                <i class="fas fa-pills fa-3x text-muted opacity-50 mb-3"></i>
                                <h6 class="text-muted">No medicines available</h6>
                                <p class="text-muted mb-0">Please contact admin to add medicines</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Right Column - Summary -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                    <div class="card-header bg-primary text-white py-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calculator me-2"></i>
                            <h6 class="mb-0 fw-bold">Transaction Summary</h6>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Services Summary -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Services</span>
                                <span class="text-success fw-bold" id="servicesSubtotal">Rp 0</span>
                            </div>
                            <div id="selectedServices" class="small text-muted">
                                No services selected
                            </div>
                        </div>

                        <hr>

                        <!-- Medicines Summary -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="fw-semibold">Medicines</span>
                                <span class="text-success fw-bold" id="medicinesSubtotal">Rp 0</span>
                            </div>
                            <div id="selectedMedicines" class="small text-muted">
                                No medicines selected
                            </div>
                        </div>

                        <hr>

                        <!-- Grand Total -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="mb-0 fw-bold">Grand Total</h5>
                                <h4 class="mb-0 fw-bold text-primary" id="grandTotal">Rp 0</h4>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary btn-lg" id="submitBtn">
                                <i class="fas fa-save me-2"></i>Create Transaction
                            </button>
                            <a href="{{ route('transactions.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>Cancel
                            </a>
                        </div>

                        <!-- Quick Add Patient -->
                        <div class="mt-3 pt-3 border-top">
                            <div class="text-center">
                                <small class="text-muted">Patient not found?</small><br>
                                <a href="{{ route('patients.create') }}" class="btn btn-outline-primary btn-sm mt-1">
                                    <i class="fas fa-user-plus me-1"></i>Add New Patient
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
.service-item {
    transition: all 0.2s ease;
    cursor: pointer;
}

.service-item:hover {
    border-color: var(--bs-primary) !important;
    background-color: rgba(var(--bs-primary-rgb), 0.02);
}

.service-item.selected {
    border-color: var(--bs-primary) !important;
    background-color: rgba(var(--bs-primary-rgb), 0.05);
}

.medicine-row {
    transition: all 0.2s ease;
}

.medicine-row.selected {
    border-color: var(--bs-info) !important;
    background-color: rgba(var(--bs-info-rgb), 0.05);
}

.sticky-top {
    position: sticky;
    top: 20px;
    z-index: 1020;
}

@media (max-width: 991.98px) {
    .sticky-top {
        position: static;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const serviceCheckboxes = document.querySelectorAll('.service-checkbox');
    const medicineCheckboxes = document.querySelectorAll('.medicine-checkbox');
    const medicineQuantities = document.querySelectorAll('.medicine-quantity');
    const patientSelect = document.getElementById('patient_id');

    // Patient selection handler
    patientSelect.addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const patientInfo = document.getElementById('patientInfo');
        
        if (this.value && selectedOption.dataset.name) {
            document.getElementById('patientName').textContent = selectedOption.dataset.name;
            document.getElementById('patientNik').textContent = selectedOption.dataset.nik;
            document.getElementById('patientPhone').textContent = selectedOption.dataset.phone;
            patientInfo.style.display = 'block';
        } else {
            patientInfo.style.display = 'none';
        }
    });

    // Trigger change event if patient is pre-selected
    if (patientSelect.value) {
        patientSelect.dispatchEvent(new Event('change'));
    }

    function updateTotals() {
        let servicesTotal = 0;
        let medicinesTotal = 0;
        let selectedServicesList = [];
        let selectedMedicinesList = [];

        // Calculate services total
        serviceCheckboxes.forEach(checkbox => {
            const serviceItem = checkbox.closest('.service-item');
            if (checkbox.checked) {
                servicesTotal += parseFloat(checkbox.dataset.price);
                selectedServicesList.push(checkbox.nextElementSibling.querySelector('h6').textContent);
                serviceItem.classList.add('selected');
            } else {
                serviceItem.classList.remove('selected');
            }
        });

        // Calculate medicines total
        medicineCheckboxes.forEach(checkbox => {
            const medicineRow = checkbox.closest('.medicine-row');
            if (checkbox.checked) {
                const quantity = document.querySelector(`input[data-medicine-id="${checkbox.dataset.medicineId}"].medicine-quantity`).value || 0;
                const total = parseFloat(checkbox.dataset.price) * parseInt(quantity);
                medicinesTotal += total;
                
                // Update individual medicine total
                document.querySelector(`div[data-medicine-id="${checkbox.dataset.medicineId}"]`).textContent = 
                    'Rp ' + total.toLocaleString('id-ID');
                
                if (quantity > 0) {
                    selectedMedicinesList.push(`${checkbox.nextElementSibling.querySelector('h6').textContent} (${quantity})`);
                }
                medicineRow.classList.add('selected');
            } else {
                medicineRow.classList.remove('selected');
                document.querySelector(`div[data-medicine-id="${checkbox.dataset.medicineId}"]`).textContent = 'Rp 0';
            }
        });

        // Update display
        document.getElementById('servicesSubtotal').textContent = 'Rp ' + servicesTotal.toLocaleString('id-ID');
        document.getElementById('medicinesSubtotal').textContent = 'Rp ' + medicinesTotal.toLocaleString('id-ID');
        document.getElementById('grandTotal').textContent = 'Rp ' + (servicesTotal + medicinesTotal).toLocaleString('id-ID');
        
        // Update counts
        document.getElementById('servicesCount').textContent = serviceCheckboxes.length ? 
            Array.from(serviceCheckboxes).filter(cb => cb.checked).length + ' selected' : '0 selected';
        document.getElementById('medicinesCount').textContent = medicineCheckboxes.length ? 
            Array.from(medicineCheckboxes).filter(cb => cb.checked).length + ' selected' : '0 selected';
        
        // Update lists
        document.getElementById('selectedServices').innerHTML = selectedServicesList.length > 0 ? 
            selectedServicesList.map(service => `• ${service}`).join('<br>') : 'No services selected';
        document.getElementById('selectedMedicines').innerHTML = selectedMedicinesList.length > 0 ? 
            selectedMedicinesList.map(medicine => `• ${medicine}`).join('<br>') : 'No medicines selected';
    }

    // Service checkbox listeners
    serviceCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateTotals);
    });

    // Medicine checkbox listeners
    medicineCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const quantityInput = document.querySelector(`input[data-medicine-id="${this.dataset.medicineId}"].medicine-quantity`);
            const buttons = quantityInput.parentNode.querySelectorAll('button');
            
            quantityInput.disabled = !this.checked;
            buttons.forEach(btn => btn.disabled = !this.checked);
            
            if (!this.checked) {
                quantityInput.value = '';
                document.querySelector(`div[data-medicine-id="${this.dataset.medicineId}"]`).textContent = 'Rp 0';
            } else {
                quantityInput.value = '1';
            }
            updateTotals();
        });
    });

    // Medicine quantity listeners
    medicineQuantities.forEach(input => {
        input.addEventListener('input', updateTotals);
    });

    // Form submission handler
    document.getElementById('transactionForm').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submitBtn');
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Creating...';
        
        // Add hidden inputs for selected medicines with quantities
        medicineCheckboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const quantity = document.querySelector(`input[data-medicine-id="${checkbox.dataset.medicineId}"].medicine-quantity`).value;
                if (quantity > 0) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `medicines[${checkbox.dataset.medicineId}][id]`;
                    hiddenInput.value = checkbox.dataset.medicineId;
                    this.appendChild(hiddenInput);

                    const hiddenQuantity = document.createElement('input');
                    hiddenQuantity.type = 'hidden';
                    hiddenQuantity.name = `medicines[${checkbox.dataset.medicineId}][quantity]`;
                    hiddenQuantity.value = quantity;
                    this.appendChild(hiddenQuantity);
                }
            }
        });
    });

    // Initial update
    updateTotals();
});

function changeQuantity(medicineId, change) {
    const quantityInput = document.querySelector(`input[data-medicine-id="${medicineId}"].medicine-quantity`);
    const checkbox = document.querySelector(`input[data-medicine-id="${medicineId}"].medicine-checkbox`);
    
    if (!checkbox.checked) return;
    
    let currentValue = parseInt(quantityInput.value) || 0;
    let newValue = currentValue + change;
    
    const maxStock = parseInt(quantityInput.getAttribute('max'));
    
    if (newValue < 1) newValue = 1;
    if (newValue > maxStock) newValue = maxStock;
    
    quantityInput.value = newValue;
    quantityInput.dispatchEvent(new Event('input'));
}
</script>
@endsection