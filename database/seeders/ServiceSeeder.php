<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            [
                'nama_layanan' => 'Pemeriksaan Umum',
                'deskripsi' => 'Pemeriksaan kesehatan rutin untuk hewan peliharaan',
                'harga' => 150000,
                'kategori' => 'Pemeriksaan',
                'durasi' => 30,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Vaksinasi',
                'deskripsi' => 'Pemberian vaksin untuk mencegah penyakit',
                'harga' => 200000,
                'kategori' => 'Pencegahan',
                'durasi' => 20,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Operasi Sterilisasi',
                'deskripsi' => 'Operasi kebiri/sterilisasi untuk hewan',
                'harga' => 1500000,
                'kategori' => 'Bedah',
                'durasi' => 120,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Rawat Inap',
                'deskripsi' => 'Perawatan intensif dengan pengawasan 24 jam',
                'harga' => 300000,
                'kategori' => 'Perawatan',
                'durasi' => 1440,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Grooming',
                'deskripsi' => 'Perawatan kebersihan dan kecantikan hewan',
                'harga' => 100000,
                'kategori' => 'Perawatan',
                'durasi' => 60,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Rontgen',
                'deskripsi' => 'Pemeriksaan radiologi untuk diagnosis',
                'harga' => 250000,
                'kategori' => 'Diagnostik',
                'durasi' => 30,
                'is_active' => true,
            ],
            [
                'nama_layanan' => 'Pembersihan Gigi',
                'deskripsi' => 'Scaling dan pembersihan gigi hewan',
                'harga' => 350000,
                'kategori' => 'Perawatan',
                'durasi' => 45,
                'is_active' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
