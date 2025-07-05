<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@midwifeclinic.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'phone' => '081234567890',
            'address' => 'Jl. Admin No. 1, Jakarta',
            'place_of_birth' => 'Jakarta',
            'date_of_birth' => '1990-01-01',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create midwife user
        User::create([
            'name' => 'Bidan Sarah',
            'email' => 'sarah@midwifeclinic.com',
            'password' => Hash::make('password'),
            'role' => 'midwife',
            'phone' => '081234567891',
            'address' => 'Jl. Midwife No. 2, Jakarta',
            'place_of_birth' => 'Jakarta',
            'date_of_birth' => '1985-05-15',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);

        // Create staff user
        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@midwifeclinic.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'phone' => '081234567892',
            'address' => 'Jl. Staff No. 3, Jakarta',
            'place_of_birth' => 'Jakarta',
            'date_of_birth' => '1995-08-20',
            'is_active' => true,
            'email_verified_at' => now(),
        ]);
    }
}
