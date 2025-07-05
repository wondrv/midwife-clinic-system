<?php

namespace App\Http\Controllers;

use App\Models\{Patient, Transaction, Medicine};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $stats = Cache::remember('dashboard_stats', 300, function () {
            return [
                'patients_today' => Patient::whereDate('created_at', today())->count(),
                'total_patients' => Patient::count(),
                'transactions_today' => Transaction::today()->count(),
                'revenue_today' => Transaction::today()->sum('total_amount'),
                'profit_today' => Transaction::today()->sum('total_profit'),
                'unpaid_transactions' => Transaction::unpaid()->count(),
                'low_stock_medicines' => Medicine::lowStock()->count(),
            ];
        });

        $recent_transactions = Transaction::with(['patient', 'user', 'services', 'medicines'])
            ->latest()
            ->take(8)
            ->get();

        $low_stock_medicines = Medicine::lowStock()
            ->active()
            ->orderBy('stock')
            ->take(10)
            ->get();

        return view('dashboard.index', compact('stats', 'recent_transactions', 'low_stock_medicines'));
    }
}