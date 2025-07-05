<?php

namespace Database\Seeders;

use App\Models\Medicine;
use Illuminate\Database\Seeder;

class MedicineSeeder extends Seeder
{
    public function run(): void
    {
        $medicines = [
            ['name' => 'Folic Acid 400mcg', 'stock' => 100, 'base_price' => 5000, 'selling_price' => 8000],
            ['name' => 'Iron Supplement 65mg', 'stock' => 75, 'base_price' => 7000, 'selling_price' => 12000],
            ['name' => 'Prenatal Vitamins', 'stock' => 50, 'base_price' => 15000, 'selling_price' => 25000],
            ['name' => 'Calcium Carbonate 500mg', 'stock' => 80, 'base_price' => 8000, 'selling_price' => 15000],
            ['name' => 'Paracetamol 500mg', 'stock' => 200, 'base_price' => 2000, 'selling_price' => 5000],
            ['name' => 'Antacid Tablets', 'stock' => 3, 'base_price' => 3000, 'selling_price' => 6000], // Low stock
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}