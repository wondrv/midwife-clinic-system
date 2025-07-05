<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Patient::query();

        if ($request->filled('search')) {
            $query->search($request->search);
        }

        $patients = $query->orderBy('name')->paginate(15)->withQueryString();

        return view('dashboard.patients.index', compact('patients'));
    }

    public function create()
    {
        return view('dashboard.patients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => 'required|string|unique:patients,nik|max:20',
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Patient created successfully.');
    }

    public function show(Patient $patient)
    {
        $transactions = $patient->transactions()
            ->with(['services', 'medicines', 'user'])
            ->latest()
            ->paginate(10);

        return view('dashboard.patients.show', compact('patient', 'transactions'));
    }

    public function edit(Patient $patient)
    {
        return view('dashboard.patients.edit', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nik' => ['required', 'string', 'max:20', Rule::unique('patients')->ignore($patient)],
            'place_of_birth' => 'required|string|max:255',
            'date_of_birth' => 'required|date|before:today',
            'address' => 'required|string',
            'phone' => 'required|string|max:20',
        ]);

        $patient->update($request->all());

        return redirect()->route('patients.show', $patient)->with('success', 'Patient updated successfully.');
    }
}