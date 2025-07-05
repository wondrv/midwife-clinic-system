<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Service extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'midwife_fee', 'is_active'];

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
            'midwife_fee' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function transactionServices()
    {
        return $this->hasMany(TransactionService::class);
    }

    // Accessors
    protected function profit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price - $this->midwife_fee,
        );
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}