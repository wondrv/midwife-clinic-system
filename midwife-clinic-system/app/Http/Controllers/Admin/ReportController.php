<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Transaction, Patient};
use Illuminate\Http\Request;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function transactions(Request $request)
    {
        $query = Transaction::with(['patient', 'user', 'services', 'medicines']);
        
        // Date filtering
        if ($request->filled('date_from')) {
            $query->whereDate('transaction_date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('transaction_date', '<=', $request->date_to);
        }
        
        // Quick filters
        if ($request->filled('period')) {
            switch ($request->period) {
                case 'today':
                    $query->whereDate('transaction_date', today());
                    break;
                case 'week':
                    $query->whereBetween('transaction_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'month':
                    $query->whereMonth('transaction_date', now()->month)
                          ->whereYear('transaction_date', now()->year);
                    break;
            }
        }

        // Profit range filtering
        if ($request->filled('profit_min')) {
            $query->where('total_profit', '>=', $request->profit_min);
        }
        
        if ($request->filled('profit_max')) {
            $query->where('total_profit', '<=', $request->profit_max);
        }

        // Status filtering
        if ($request->filled('status')) {
            if ($request->status === 'paid') {
                $query->where('is_paid', true);
            } elseif ($request->status === 'unpaid') {
                $query->where('is_paid', false);
            }
        }

        // Patient search
        if ($request->filled('patient_search')) {
            $query->whereHas('patient', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->patient_search . '%')
                  ->orWhere('phone', 'like', '%' . $request->patient_search . '%');
            });
        }
        
        // Sorting
        $sortBy = $request->get('sort', 'date');
        $sortOrder = $request->get('order', 'desc');
        
        switch ($sortBy) {
            case 'profit':
                $query->orderBy('total_profit', $sortOrder);
                break;
            case 'amount':
                $query->orderBy('total_amount', $sortOrder);
                break;
            default:
                $query->orderBy('transaction_date', $sortOrder);
                break;
        }
        
        $transactions = $query->paginate(20)->withQueryString();
        
        // Statistics
        $totalTransactions = Transaction::when($request->filled('date_from'), function($q) use ($request) {
            return $q->whereDate('transaction_date', '>=', $request->date_from);
        })->when($request->filled('date_to'), function($q) use ($request) {
            return $q->whereDate('transaction_date', '<=', $request->date_to);
        })->when($request->filled('period'), function($q) use ($request) {
            switch ($request->period) {
                case 'today':
                    return $q->whereDate('transaction_date', today());
                case 'week':
                    return $q->whereBetween('transaction_date', [now()->startOfWeek(), now()->endOfWeek()]);
                case 'month':
                    return $q->whereMonth('transaction_date', now()->month)
                             ->whereYear('transaction_date', now()->year);
            }
            return $q;
        });
        
        $stats = [
            'total_transactions' => $totalTransactions->count(),
            'total_revenue' => $totalTransactions->sum('total_amount'),
            'total_profit' => $totalTransactions->sum('total_profit'),
        ];
        
        return view('admin.reports.transactions', compact('transactions', 'stats'));
    }
    
    public function patients(Request $request)
    {
        $query = Patient::with(['transactions.services', 'transactions.medicines']);
        
        // Search by name, phone, or NIK
        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%')
                  ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        // Date range for patient registration
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Filter by transaction status
        if ($request->filled('transaction_status')) {
            if ($request->transaction_status === 'has_transactions') {
                $query->has('transactions');
            } elseif ($request->transaction_status === 'no_transactions') {
                $query->doesntHave('transactions');
            }
        }

        // Filter by transaction amount range
        if ($request->filled('amount_min') || $request->filled('amount_max')) {
            $query->whereHas('transactions', function($q) use ($request) {
                if ($request->filled('amount_min')) {
                    $q->where('total_amount', '>=', $request->amount_min);
                }
                if ($request->filled('amount_max')) {
                    $q->where('total_amount', '<=', $request->amount_max);
                }
            });
        }

        // Time range filters for transactions
        if ($request->filled('transaction_period')) {
            $query->whereHas('transactions', function($q) use ($request) {
                switch ($request->transaction_period) {
                    case '1_day':
                        $q->whereDate('created_at', today());
                        break;
                    case '1_week':
                        $q->whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;
                    case '1_month':
                        $q->whereMonth('created_at', now()->month)
                          ->whereYear('created_at', now()->year);
                        break;
                }
            });
        }

        // Sorting
        $sortBy = $request->get('sort', 'name');
        $sortOrder = $request->get('order', 'asc');
        
        switch ($sortBy) {
            case 'transactions_count':
                $query->withCount('transactions')->orderBy('transactions_count', $sortOrder);
                break;
            case 'total_spent':
                $query->withSum('transactions', 'total_amount')->orderBy('transactions_sum_total_amount', $sortOrder);
                break;
            case 'last_visit':
                $query->with(['transactions' => function($q) {
                    $q->latest()->take(1);
                }])->orderBy('created_at', $sortOrder);
                break;
            default:
                $query->orderBy($sortBy, $sortOrder);
                break;
        }

        $patients = $query->paginate(15)->withQueryString();

        // Statistics
        $stats = [
            'total_patients' => Patient::count(),
            'patients_with_transactions' => Patient::has('transactions')->count(),
            'patients_this_month' => Patient::whereMonth('created_at', now()->month)
                                           ->whereYear('created_at', now()->year)
                                           ->count(),
        ];

        return view('admin.reports.patients', compact('patients', 'stats'));
    }
}
