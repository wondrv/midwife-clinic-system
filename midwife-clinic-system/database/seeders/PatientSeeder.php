<?php

namespace Database\Seeders;

use App\Models\Patient;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'name' => 'Sari Wijaya',
                'nik' => '3171234567890001',
                'place_of_birth' => 'Jakarta',
                'date_of_birth' => '1992-03-15',
                'address' => 'Jl. Mawar No. 123, Kebayoran Baru, Jakarta Selatan',
                'phone' => '081234567890',
            ],
            [
                'name' => 'Dewi Anggraini',
                'nik' => '3171234567890002',
                'place_of_birth' => 'Bandung',
                'date_of_birth' => '1988-07-22',
                'address' => 'Jl. Melati No. 456, Menteng, Jakarta Pusat',
                'phone' => '081234567891',
            ],
            [
                'name' => 'Rita Kusuma',
                'nik' => '3171234567890003',
                'place_of_birth' => 'Surabaya',
                'date_of_birth' => '1995-11-08',
                'address' => 'Jl. Kenanga No. 789, Kelapa Gading, Jakarta Utara',
                'phone' => '081234567892',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}