<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'patient_id', 'user_id',
        'services_subtotal', 'medicines_subtotal',
        'total_amount', 'total_profit', 'payment_status', 'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'services_subtotal' => 'decimal:2',
            'medicines_subtotal' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'total_profit' => 'decimal:2',
            'paid_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaction) {
            if (empty($transaction->transaction_id)) {
                $transaction->transaction_id = 'TRX-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }

    // Relationships
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function services()
    {
        return $this->hasMany(TransactionService::class);
    }

    public function medicines()
    {
        return $this->hasMany(TransactionMedicine::class);
    }

    // Accessors
    protected function isPaid(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->payment_status === 'paid',
        );
    }

    // Methods
    public function markAsPaid(): void
    {
        $this->update([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ]);
    }

    public function calculateTotals(): void
    {
        $this->services_subtotal = $this->services->sum('price');
        $this->medicines_subtotal = $this->medicines->sum('total_price');
        $this->total_amount = $this->services_subtotal + $this->medicines_subtotal;
        
        $servicesProfit = $this->services->sum('profit');
        $medicinesProfit = $this->medicines->sum('total_profit');
        $this->total_profit = $servicesProfit + $medicinesProfit;

        $this->save();
    }

    // Scopes
    public function scopePaid($query)
    {
        return $query->where('payment_status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('payment_status', 'unpaid');
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }
}