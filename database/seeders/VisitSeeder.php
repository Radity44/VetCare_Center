<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Visit;
use Carbon\Carbon;

class VisitSeeder extends Seeder
{
    public function run(): void
    {
        $visits = [
            [
                'id_pasien' => 1,
                'id_dokter' => 1,
                'id_layanan' => 1,
                'tanggal_kunjungan' => Carbon::now()->subDays(2),
                'keluhan' => 'Demam tinggi dan lemas',
                'diagnosis' => 'Infeksi virus ringan',
                'tindakan' => 'Pemberian antibiotik dan vitamin',
                'catatan' => 'Kontrol 3 hari lagi',
                'total_biaya' => 250000,
            ],
            [
                'id_pasien' => 2,
                'id_dokter' => 2,
                'id_layanan' => 2,
                'tanggal_kunjungan' => Carbon::now()->subDays(5),
                'keluhan' => 'Bulu rontok berlebihan',
                'diagnosis' => 'Alergi makanan',
                'tindakan' => 'Ganti pakan hypoallergenic',
                'catatan' => 'Hindari makanan laut',
                'total_biaya' => 180000,
            ],
            [
                'id_pasien' => 3,
                'id_dokter' => 1,
                'id_layanan' => 3,
                'tanggal_kunjungan' => Carbon::now()->subDays(10),
                'keluhan' => 'Benjolan di perut',
                'diagnosis' => 'Hernia umbilical',
                'tindakan' => 'Operasi hernia',
                'catatan' => 'Operasi berjalan lancar, rawat luka 7 hari',
                'total_biaya' => 1500000,
            ],
            [
                'id_pasien' => 4,
                'id_dokter' => 3,
                'id_layanan' => 4,
                'tanggal_kunjungan' => Carbon::now()->subDay(),
                'keluhan' => 'Tidak mau makan',
                'diagnosis' => 'Gangguan pencernaan',
                'tindakan' => 'Rawat inap dan infus',
                'catatan' => 'Observasi 24 jam',
                'total_biaya' => 450000,
            ],
            [
                'id_pasien' => 5,
                'id_dokter' => 2,
                'id_layanan' => 5,
                'tanggal_kunjungan' => Carbon::now(),
                'keluhan' => 'Kontrol pasca sterilisasi',
                'diagnosis' => 'Pemulihan berjalan baik',
                'tindakan' => 'Pembersihan luka dan pemberian vitamin',
                'catatan' => 'Bisa pulang besok',
                'total_biaya' => 200000,
            ],
            [
                'id_pasien' => 6,
                'id_dokter' => 4,
                'id_layanan' => 7,
                'tanggal_kunjungan' => Carbon::now()->subDays(3),
                'keluhan' => 'Gigi kotor dan bau mulut',
                'diagnosis' => 'Karang gigi berlebih',
                'tindakan' => 'Scaling dan pembersihan gigi',
                'catatan' => 'Berikan makanan khusus dental',
                'total_biaya' => 350000,
            ],
        ];
        

        foreach ($visits as $visit) {
            Visit::create($visit);
        }
    }
}
