@extends('layouts.app')

@section('title', '- ' . __('app.edit_service'))

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">{{ __('app.edit_service') }}</h1>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.services.update', $service) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label">{{ __('app.service_name') }} *</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                           id="name" name="name" value="{{ old('name', $service->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="price" class="form-label">{{ __('app.service_price') }} *</label>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                   id="price" name="price" value="{{ old('price', $service->price) }}" min="0" step="1000" required>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="midwife_fee" class="form-label">{{ __('app.fee_for_midwife') }} *</label>
                            <input type="number" class="form-control @error('midwife_fee') is-invalid @enderror" 
                                   id="midwife_fee" name="midwife_fee" value="{{ old('midwife_fee', $service->midwife_fee) }}" min="0" step="1000" required>
                            @error('midwife_fee')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">{{ __('app.calculated_profit') }}</label>
                    <div class="form-control-plaintext" id="calculatedProfit">Rp {{ number_format($service->profit, 0, ',', '.') }}</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">{{ __('app.description') }}</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              id="description" name="description" rows="3">{{ old('description', $service->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ __('app.update_service') }}</button>
                    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">{{ __('app.cancel') }}</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const priceInput = document.getElementById('price');
    const midwifeFeeInput = document.getElementById('midwife_fee');
    const profitDisplay = document.getElementById('calculatedProfit');
    
    function updateProfit() {
        const price = parseFloat(priceInput.value) || 0;
        const midwifeFee = parseFloat(midwifeFeeInput.value) || 0;
        const profit = price - midwifeFee;
        
        profitDisplay.textContent = 'Rp ' + profit.toLocaleString('id-ID');
        
        if (profit < 0) {
            profitDisplay.className = 'form-control-plaintext text-danger';
        } else {
            profitDisplay.className = 'form-control-plaintext text-success';
        }
    }
    
    priceInput.addEventListener('input', updateProfit);
    midwifeFeeInput.addEventListener('input', updateProfit);
    
    // Initial calculation
    updateProfit();
});
</script>
@endsection
