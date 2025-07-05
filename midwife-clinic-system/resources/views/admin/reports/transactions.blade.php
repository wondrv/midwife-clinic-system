@extends('layouts.app')

@section('title', '- ' . __('app.transaction_reports'))

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 mb-0">{{ __('app.transaction_reports') }}</h1>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ __('app.total_transactions') }}</h5>
                    <h2 class="mb-0">{{ number_format($stats['total_transactions']) }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ __('app.total_revenue') }}</h5>
                    <h2 class="mb-0">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-info text-white">
                <div class="card-body">
                    <h5 class="card-title">{{ __('app.total_profit') }}</h5>
                    <h2 class="mb-0">Rp {{ number_format($stats['total_profit'], 0, ',', '.') }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-4">
        <div class="card-header">
            <h5 class="mb-0">{{ __('app.filters') }}</h5>
        </div>
        <div class="card-body">
            <form method="GET">
                <div class="row">
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="date_from" class="form-label">From Date</label>
                            <input type="date" class="form-control" id="date_from" name="date_from" value="{{ request('date_from') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="date_to" class="form-label">To Date</label>
                            <input type="date" class="form-control" id="date_to" name="date_to" value="{{ request('date_to') }}">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="period" class="form-label">Quick Filter</label>
                            <select class="form-select" id="period" name="period">
                                <option value="">All Time</option>
                                <option value="today" {{ request('period') == 'today' ? 'selected' : '' }}>Today</option>
                                <option value="week" {{ request('period') == 'week' ? 'selected' : '' }}>This Week</option>
                                <option value="month" {{ request('period') == 'month' ? 'selected' : '' }}>This Month</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="sort" class="form-label">Sort By</label>
                            <select class="form-select" id="sort" name="sort">
                                <option value="date" {{ request('sort') == 'date' ? 'selected' : '' }}>Date</option>
                                <option value="amount" {{ request('sort') == 'amount' ? 'selected' : '' }}>Amount</option>
                                <option value="profit" {{ request('sort') == 'profit' ? 'selected' : '' }}>Profit</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label for="order" class="form-label">Order</label>
                            <select class="form-select" id="order" name="order">
                                <option value="desc" {{ request('order') == 'desc' ? 'selected' : '' }}>Highest First</option>
                                <option value="asc" {{ request('order') == 'asc' ? 'selected' : '' }}>Lowest First</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="mb-3">
                            <label class="form-label">&nbsp;</label>
                            <div>
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Transaction ID</th>
                            <th>Date</th>
                            <th>Patient</th>
                            <th>Total Amount</th>
                            <th>Total Profit</th>
                            <th>Payment Status</th>
                            <th>Staff</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->transaction_id }}</td>
                            <td>{{ $transaction->created_at->format('M j, Y') }}</td>
                            <td>{{ $transaction->patient->name }}</td>
                            <td>Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($transaction->total_profit, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $transaction->payment_status === 'paid' ? 'success' : 'warning' }}">
                                    {{ ucfirst($transaction->payment_status) }}
                                </span>
                            </td>
                            <td>{{ $transaction->user->name }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">No transactions found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection
