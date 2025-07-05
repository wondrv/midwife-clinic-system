<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionMedicine extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id', 'medicine_id', 'medicine_name',
        'quantity', 'base_price', 'selling_price',
        'profit', 'total_price', 'total_profit',
    ];

    protected function casts(): array
    {
        return [
            'quantity' => 'integer',
            'base_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'profit' => 'decimal:2',
            'total_price' => 'decimal:2',
            'total_profit' => 'decimal:2',
        ];
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}