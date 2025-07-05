<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\MedicineController as AdminMedicineController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\ReportController as AdminReportController;
use App\Http\Controllers\LanguageController;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/services', [PublicController::class, 'services'])->name('public.services');
Route::get('/contact', [PublicController::class, 'contact'])->name('public.contact');
Route::post('/contact', [PublicController::class, 'submitContact'])->name('public.contact.submit');

// Language switching
Route::post('/language/switch', [LanguageController::class, 'switch'])->name('language.switch');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Patient & Transaction Management
    Route::resource('patients', PatientController::class);
    Route::resource('transactions', TransactionController::class);
    Route::patch('/transactions/{transaction}/mark-paid', [TransactionController::class, 'markAsPaid'])->name('transactions.mark-paid');
    Route::get('/transactions/{transaction}/print', [TransactionController::class, 'printReceipt'])->name('transactions.print');
    
    // Admin routes
    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('services', AdminServiceController::class);
        Route::resource('medicines', AdminMedicineController::class);
        Route::resource('users', AdminUserController::class);
        
        // Reports
        Route::get('/reports/transactions', [AdminReportController::class, 'transactions'])->name('reports.transactions');
        Route::get('/reports/patients', [AdminReportController::class, 'patients'])->name('reports.patients');
    });
});

require __DIR__.'/auth.php';