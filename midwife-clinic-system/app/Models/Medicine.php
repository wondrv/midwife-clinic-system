<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Medicine extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'base_price', 'selling_price', 'is_active'];

    protected function casts(): array
    {
        return [
            'stock' => 'integer',
            'base_price' => 'decimal:2',
            'selling_price' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    // Relationships
    public function transactionMedicines()
    {
        return $this->hasMany(TransactionMedicine::class);
    }

    // Accessors
    protected function profit(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->selling_price - $this->base_price,
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->selling_price,
        );
    }

    protected function stockStatus(): Attribute
    {
        return Attribute::make(
            get: fn () => match (true) {
                $this->stock <= 0 => 'out_of_stock',
                $this->stock <= 5 => 'low_stock',
                default => 'in_stock'
            },
        );
    }

    protected function profitPercentage(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->base_price > 0 ? (($this->selling_price - $this->base_price) / $this->base_price) * 100 : 0,
        );
    }

    // Helper methods
    public function isLowStock(): bool
    {
        return $this->stock <= 5;
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLowStock($query)
    {
        return $query->where('stock', '<=', 5);
    }
}