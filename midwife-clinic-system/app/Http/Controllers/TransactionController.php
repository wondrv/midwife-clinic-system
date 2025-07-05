<?php

namespace App\Http\Controllers;

use App\Models\{Transaction, Patient, Service, Medicine, TransactionService, TransactionMedicine};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Transaction::with(['patient', 'user']);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('transaction_id', 'like', "%{$search}%")
                  ->orWhereHas('patient', function ($pq) use ($search) {
                      $pq->where('name', 'like', "%{$search}%")
                        ->orWhere('nik', 'like', "%{$search}%");
                  });
            });
        }

        // Date filters
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Payment status filter
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $transactions = $query->latest()->paginate(15)->withQueryString();

        return view('dashboard.transactions.index', compact('transactions'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $services = Service::active()->get();
        $medicines = Medicine::active()->where('stock', '>', 0)->get();

        return view('dashboard.transactions.create', compact('patients', 'services', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'services' => 'nullable|array',
            'services.*' => 'exists:services,id',
            'medicines' => 'nullable|array',
            'medicines.*.id' => 'exists:medicines,id',
            'medicines.*.quantity' => 'integer|min:1',
            'notes' => 'nullable|string',
        ]);

        // Validate medicine stock
        if ($request->has('medicines')) {
            foreach ($request->medicines as $medicineData) {
                $medicine = Medicine::find($medicineData['id']);
                if ($medicine->stock < $medicineData['quantity']) {
                    return back()->withErrors([
                        'medicines' => "Insufficient stock for {$medicine->name}. Available: {$medicine->stock}"
                    ])->withInput();
                }
            }
        }

        DB::transaction(function () use ($request) {
            // Create transaction
            $transaction = Transaction::create([
                'patient_id' => $request->patient_id,
                'user_id' => Auth::id(),
                'services_subtotal' => 0,
                'medicines_subtotal' => 0,
                'total_amount' => 0,
                'total_profit' => 0,
                'notes' => $request->notes,
            ]);

            // Add services
            if ($request->has('services')) {
                foreach ($request->services as $serviceId) {
                    $service = Service::find($serviceId);
                    TransactionService::create([
                        'transaction_id' => $transaction->id,
                        'service_id' => $service->id,
                        'service_name' => $service->name,
                        'price' => $service->price,
                        'midwife_fee' => $service->midwife_fee,
                        'profit' => $service->profit,
                    ]);
                }
            }

            // Add medicines
            if ($request->has('medicines')) {
                foreach ($request->medicines as $medicineData) {
                    $medicine = Medicine::find($medicineData['id']);
                    $quantity = $medicineData['quantity'];
                    
                    TransactionMedicine::create([
                        'transaction_id' => $transaction->id,
                        'medicine_id' => $medicine->id,
                        'medicine_name' => $medicine->name,
                        'quantity' => $quantity,
                        'base_price' => $medicine->base_price,
                        'selling_price' => $medicine->selling_price,
                        'profit' => $medicine->profit,
                        'total_price' => $medicine->selling_price * $quantity,
                        'total_profit' => $medicine->profit * $quantity,
                    ]);

                    // Update stock
                    $medicine->decrement('stock', $quantity);
                }
            }

            // Calculate totals
            $transaction->calculateTotals();
        });

        return redirect()->route('patients.show', $request->patient_id)->with('success', 'Transaction created successfully.');
    }

    public function show(Transaction $transaction)
    {
        $transaction->load(['patient', 'user', 'services', 'medicines']);
        return view('dashboard.transactions.show', compact('transaction'));
    }

    public function markAsPaid(Transaction $transaction)
    {
        $this->authorize('update', $transaction);
        
        $transaction->update([
            'is_paid' => true,
            'paid_at' => now()
        ]);

        return redirect()->back()->with('success', 'Transaction marked as paid successfully.');
    }

    public function invoice(Transaction $transaction)
    {
        $transaction->load(['patient', 'user', 'services', 'medicines']);
        return view('dashboard.transactions.invoice', compact('transaction'));
    }

    public function printReceipt(Transaction $transaction)
    {
        $transaction->load(['patient', 'services', 'medicines', 'user']);
        
        return view('dashboard.transactions.print', compact('transaction'));
    }
}