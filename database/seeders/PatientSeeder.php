<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Patient;

class PatientSeeder extends Seeder
{
    public function run(): void
    {
        $patients = [
            [
                'nama_hewan' => 'Bobby',
                'jenis_hewan' => 'Anjing',
                'ras' => 'Golden Retriever',
                'umur_hewan' => 3,
                'jenis_kelamin' => 'Jantan',
                'riwayat_perawatan' => 'Vaksinasi rutin, pemeriksaan kesehatan tahunan',
                'status' => 'Booking',
            ],
            [
                'nama_hewan' => 'Mittens',
                'jenis_hewan' => 'Kucing',
                'ras' => 'Persian',
                'umur_hewan' => 2,
                'jenis_kelamin' => 'Betina',
                'riwayat_perawatan' => 'Sterilisasi, vaksinasi lengkap',
                'status' => 'Pemeriksaan',
            ],
            [
                'nama_hewan' => 'Charlie',
                'jenis_hewan' => 'Anjing',
                'ras' => 'Beagle',
                'umur_hewan' => 5,
                'jenis_kelamin' => 'Jantan',
                'riwayat_perawatan' => 'Operasi tumor jinak tahun lalu',
                'status' => 'Pra-Karantina',
            ],
            [
                'nama_hewan' => 'Luna',
                'jenis_hewan' => 'Kucing',
                'ras' => 'Anggora',
                'umur_hewan' => 1,
                'jenis_kelamin' => 'Betina',
                'riwayat_perawatan' => 'Vaksinasi awal',
                'status' => 'Operasi',
            ],
            [
                'nama_hewan' => 'Max',
                'jenis_hewan' => 'Anjing',
                'ras' => 'Labrador',
                'umur_hewan' => 4,
                'jenis_kelamin' => 'Jantan',
                'riwayat_perawatan' => 'Perawatan rutin',
                'status' => 'Pasca-Karantina',
            ],
            [
                'nama_hewan' => 'Bella',
                'jenis_hewan' => 'Kucing',
                'ras' => 'Maine Coon',
                'umur_hewan' => 3,
                'jenis_kelamin' => 'Betina',
                'riwayat_perawatan' => 'Grooming berkala',
                'status' => 'Rawat Jalan',
            ],
            [
                'nama_hewan' => 'Rocky',
                'jenis_hewan' => 'Anjing',
                'ras' => 'Bulldog',
                'umur_hewan' => 6,
                'jenis_kelamin' => 'Jantan',
                'riwayat_perawatan' => 'Terapi fisik pasca operasi',
                'status' => 'Selesai',
            ],
            [
                'nama_hewan' => 'Whiskers',
                'jenis_hewan' => 'Kucing',
                'ras' => 'Domestik',
                'umur_hewan' => 4,
                'jenis_kelamin' => 'Jantan',
                'riwayat_perawatan' => 'Vaksinasi lengkap',
                'status' => 'Booking',
            ],
        ];

        foreach ($patients as $patient) {
            Patient::create($patient);
        }
    }
}