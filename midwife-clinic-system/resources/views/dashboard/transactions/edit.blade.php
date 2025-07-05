@extends('layouts.app')

@section('title', '- Edit Transaction')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">Edit Transaction</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('transactions.update', $transaction) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="patient_id" class="form-label">Patient</label>
                    <select class="form-select @error('patient_id') is-invalid @enderror" id="patient_id" name="patient_id" required>
                        <option value="">Select Patient</option>
                        @foreach($patients ?? [] as $patient)
                            <option value="{{ $patient->id }}" {{ old('patient_id', $transaction->patient_id ?? '') == $patient->id ? 'selected' : '' }}>
                                {{ $patient->name }} - {{ $patient->nik }}
                            </option>
                        @endforeach
                    </select>
                    @error('patient_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="total_amount" class="form-label">Total Amount</label>
                    <input type="number" class="form-control @error('total_amount') is-invalid @enderror" 
                           id="total_amount" name="total_amount" value="{{ old('total_amount', $transaction->total_amount ?? '') }}" min="0" step="1000" required>
                    @error('total_amount')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="payment_status" class="form-label">Payment Status</label>
                    <select class="form-select @error('payment_status') is-invalid @enderror" id="payment_status" name="payment_status" required>
                        <option value="unpaid" {{ old('payment_status', $transaction->payment_status ?? '') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                        <option value="paid" {{ old('payment_status', $transaction->payment_status ?? '') == 'paid' ? 'selected' : '' }}>Paid</option>
                    </select>
                    @error('payment_status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea class="form-control @error('notes') is-invalid @enderror" 
                              id="notes" name="notes" rows="3">{{ old('notes', $transaction->notes ?? '') }}</textarea>
                    @error('notes')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update Transaction</button>
                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection