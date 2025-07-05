<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Prenatal Checkup', 'price' => 200000, 'midwife_fee' => 150000],
            ['name' => 'Labor & Delivery Assistance', 'price' => 1500000, 'midwife_fee' => 1000000],
            ['name' => 'Postnatal Care', 'price' => 300000, 'midwife_fee' => 200000],
            ['name' => 'Breastfeeding Consultation', 'price' => 150000, 'midwife_fee' => 100000],
            ['name' => 'Family Planning Consultation', 'price' => 175000, 'midwife_fee' => 125000],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}