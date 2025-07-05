<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionService extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'service_id', 'service_name',
        'price', 'midwife_fee', 'profit',
    ];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'midwife_fee' => 'decimal:2',
            'profit' => 'decimal:2',
        ];
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}