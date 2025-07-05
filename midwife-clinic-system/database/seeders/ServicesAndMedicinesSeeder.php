<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{Service, Medicine};

class ServicesAndMedicinesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample Services
        $services = [
            [
                'name' => 'Prenatal Care Consultation',
                'price' => 150000,
                'midwife_fee' => 100000,
                'is_active' => true,
            ],
            [
                'name' => 'Normal Delivery',
                'price' => 2500000,
                'midwife_fee' => 1500000,
                'is_active' => true,
            ],
            [
                'name' => 'Postnatal Care',
                'price' => 200000,
                'midwife_fee' => 120000,
                'is_active' => true,
            ],
            [
                'name' => 'Family Planning Consultation',
                'price' => 100000,
                'midwife_fee' => 60000,
                'is_active' => true,
            ],
            [
                'name' => 'Baby Immunization',
                'price' => 75000,
                'midwife_fee' => 40000,
                'is_active' => true,
            ],
            [
                'name' => 'Pregnancy Test',
                'price' => 50000,
                'midwife_fee' => 25000,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }

        // Sample Medicines
        $medicines = [
            [
                'name' => 'Folic Acid 400mcg',
                'stock' => 100,
                'base_price' => 5000,
                'selling_price' => 8000,
                'is_active' => true,
            ],
            [
                'name' => 'Iron Supplement',
                'stock' => 80,
                'base_price' => 10000,
                'selling_price' => 15000,
                'is_active' => true,
            ],
            [
                'name' => 'Vitamin D3',
                'stock' => 60,
                'base_price' => 15000,
                'selling_price' => 25000,
                'is_active' => true,
            ],
            [
                'name' => 'Calcium Carbonate',
                'stock' => 50,
                'base_price' => 12000,
                'selling_price' => 20000,
                'is_active' => true,
            ],
            [
                'name' => 'Prenatal Vitamins',
                'stock' => 40,
                'base_price' => 25000,
                'selling_price' => 40000,
                'is_active' => true,
            ],
            [
                'name' => 'Paracetamol 500mg',
                'stock' => 200,
                'base_price' => 2000,
                'selling_price' => 5000,
                'is_active' => true,
            ],
            [
                'name' => 'Antacid Tablets',
                'stock' => 3,  // Low stock for testing
                'base_price' => 8000,
                'selling_price' => 12000,
                'is_active' => true,
            ],
        ];

        foreach ($medicines as $medicine) {
            Medicine::create($medicine);
        }
    }
}
