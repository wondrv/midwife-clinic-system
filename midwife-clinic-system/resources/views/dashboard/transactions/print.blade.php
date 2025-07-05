<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Receipt - {{ $transaction->transaction_id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            background: white;
        }
        .receipt {
            max-width: 400px;
            margin: 0 auto;
            border: 1px solid #ddd;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }
        .clinic-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .clinic-info {
            font-size: 10px;
            color: #666;
        }
        .section {
            margin-bottom: 15px;
        }
        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            border-bottom: 1px solid #eee;
            padding-bottom: 2px;
        }
        .row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        .total-row {
            border-top: 1px solid #333;
            padding-top: 5px;
            font-weight: bold;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            font-size: 10px;
            color: #666;
        }
        @media print {
            body { margin: 0; padding: 10px; }
            .receipt { border: none; box-shadow: none; }
        }
    </style>
</head>
<body>
    <div class="receipt">
        <div class="header">
            <div class="clinic-name">{{ config('app.name', 'Midwife Clinic') }}</div>
            <div class="clinic-info">
                Jl. Clinic Address No. 123<br>
                Phone: (021) 1234-5678<br>
                Email: info@midwifeclinic.com
            </div>
        </div>

        <div class="section">
            <div class="section-title">Transaction Details</div>
            <div class="row">
                <span>Transaction ID:</span>
                <span>{{ $transaction->transaction_id }}</span>
            </div>
            <div class="row">
                <span>Date:</span>
                <span>{{ $transaction->created_at->format('d/m/Y H:i') }}</span>
            </div>
            <div class="row">
                <span>Staff:</span>
                <span>{{ $transaction->user->name }}</span>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Patient Information</div>
            <div class="row">
                <span>Name:</span>
                <span>{{ $transaction->patient->name }}</span>
            </div>
            <div class="row">
                <span>NIK:</span>
                <span>{{ $transaction->patient->nik }}</span>
            </div>
            <div class="row">
                <span>Phone:</span>
                <span>{{ $transaction->patient->phone }}</span>
            </div>
        </div>

        @if($transaction->services->count() > 0)
        <div class="section">
            <div class="section-title">Services</div>
            @foreach($transaction->services as $service)
            <div class="row">
                <span>{{ $service->name }}</span>
                <span>Rp {{ number_format($service->pivot->price, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
        @endif

        @if($transaction->medicines->count() > 0)
        <div class="section">
            <div class="section-title">Medicines</div>
            @foreach($transaction->medicines as $medicine)
            <div class="row">
                <span>{{ $medicine->name }} ({{ $medicine->pivot->quantity }}x)</span>
                <span>Rp {{ number_format($medicine->pivot->subtotal, 0, ',', '.') }}</span>
            </div>
            @endforeach
        </div>
        @endif

        @if($transaction->notes)
        <div class="section">
            <div class="section-title">Notes</div>
            <div>{{ $transaction->notes }}</div>
        </div>
        @endif

        <div class="section">
            <div class="row total-row">
                <span>TOTAL AMOUNT:</span>
                <span>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
            </div>
            <div class="row">
                <span>Payment Status:</span>
                <span>{{ $transaction->is_paid ? 'PAID' : 'UNPAID' }}</span>
            </div>
            @if($transaction->is_paid && $transaction->paid_at)
            <div class="row">
                <span>Paid Date:</span>
                <span>{{ $transaction->paid_at->format('d/m/Y H:i') }}</span>
            </div>
            @endif
        </div>

        <div class="footer">
            <div>Thank you for choosing our services!</div>
            <div>Get well soon!</div>
            <div style="margin-top: 10px;">
                Printed on: {{ now()->format('d/m/Y H:i:s') }}
            </div>
        </div>
    </div>

    <script>
        // Auto print when page loads
        window.onload = function() {
            window.print();
        }
        
        // Close window after printing
        window.onafterprint = function() {
            window.close();
        }
    </script>
</body>
</html>
