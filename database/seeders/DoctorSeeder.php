<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        $doctors = [
            [
                'nama' => 'Dr. Sarah Johnson',
                'spesialis' => 'Bedah Hewan',
                'telepon' => '081234567890',
                'email' => 'sarah.johnson@vetcare.com',
                'alamat' => 'Jl. Veteran No. 123, Jakarta',
                'is_active' => true,
            ],
            [
                'nama' => 'Dr. Michael Chen',
                'spesialis' => 'Hewan Kecil',
                'telepon' => '081234567891',
                'email' => 'michael.chen@vetcare.com',
                'alamat' => 'Jl. Sudirman No. 456, Jakarta',
                'is_active' => true,
            ],
            [
                'nama' => 'Dr. Amanda Williams',
                'spesialis' => 'Hewan Eksotis',
                'telepon' => '081234567892',
                'email' => 'amanda.williams@vetcare.com',
                'alamat' => 'Jl. Thamrin No. 789, Jakarta',
                'is_active' => true,
            ],
            [
                'nama' => 'Dr. David Lee',
                'spesialis' => 'Dermatologi Hewan',
                'telepon' => '081234567893',
                'email' => 'david.lee@vetcare.com',
                'alamat' => 'Jl. Gatot Subroto No. 321, Jakarta',
                'is_active' => true,
            ],
        ];

        foreach ($doctors as $doctor) {
            Doctor::create($doctor);
        }
    }
}
