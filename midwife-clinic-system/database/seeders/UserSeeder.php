<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@midwifeclinic.com',
            'password' => Hash::make('password'),
            'phone' => '081234567890',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Staff Member',
            'email' => 'staff@midwifeclinic.com',
            'password' => Hash::make('password'),
            'phone' => '081234567891',
            'role' => 'staff',
        ]);

        User::create([
            'name' => 'Dr. Sarah Midwife',
            'email' => 'midwife@midwifeclinic.com',
            'password' => Hash::make('password'),
            'phone' => '081234567892',
            'role' => 'midwife',
        ]);
    }
}