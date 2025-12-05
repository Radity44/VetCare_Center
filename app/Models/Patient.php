<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_hewan',
        'jenis_hewan',
        'ras',
        'tanggal_lahir',
        'umur_hewan',
        'jenis_kelamin',
        'nama_pemilik',
        'telepon_pemilik',
        'alamat_pemilik',
        'riwayat_perawatan',
        'status',
        'judul_perawatan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    // Helper untuk hitung umur otomatis dari tanggal lahir
    public function getUmurAttribute()
    {
        if ($this->tanggal_lahir) {
            return Carbon::parse($this->tanggal_lahir)->age;
        }
        return $this->attributes['umur_hewan'] ?? 0;
    }

    // Helper untuk format umur lengkap (tahun + bulan)
    public function getUmurLengkapAttribute()
{
    // Jika tidak ada tanggal lahir, pakai umur manual
    if (!$this->tanggal_lahir) {
        return $this->umur_hewan . ' tahun';
    }
    
    try {
        $lahir = Carbon::parse($this->tanggal_lahir);
        $sekarang = Carbon::now();
        
        // VALIDASI: Jika tanggal lahir di masa depan, return error
        if ($lahir->isFuture()) {
            return 'Tanggal lahir tidak valid';
        }
        
        // Hitung total bulan (absolute value untuk hindari minus, floor untuk bulatkan)
        $totalBulan = floor(abs($lahir->diffInMonths($sekarang)));
        
        // Jika kurang dari 12 bulan (< 1 tahun), tampilkan dalam bulan
        if ($totalBulan < 12) {
            if ($totalBulan == 0) {
                // Hitung dalam hari jika baru lahir (< 1 bulan)
                $hari = floor(abs($lahir->diffInDays($sekarang)));
                
                if ($hari == 0) {
                    return 'Baru lahir';
                }
                
                return $hari . ' hari';
            }
            return $totalBulan . ' bulan';
        }
        
        // Jika >= 1 tahun, hitung tahun dan sisa bulan
        $tahun = floor(abs($lahir->diffInYears($sekarang)));
        
        // Hitung sisa bulan dengan cara yang lebih aman
        $lahirPlusTahun = $lahir->copy()->addYears($tahun);
        $bulan = floor(abs($lahirPlusTahun->diffInMonths($sekarang)));
        
        if ($bulan == 0) {
            return $tahun . ' tahun';
        } else {
            return $tahun . ' tahun ' . $bulan . ' bulan';
        }
        
    } catch (\Exception $e) {
        return 'Format tanggal salah';
    }
}


    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_pasien', 'id');
    }

    public static function getStatusList()
    {
        return [
            'Booking',
            'Pemeriksaan',
            'Pra-Karantina',
            'Operasi',
            'Pasca-Karantina',
            'Rawat Jalan',
            'Kritis',
            'Meninggal',
            'Selesai',
        ];
    }

    public static function getStatusColor($status)
    {
        return match($status) {
            'Booking' => 'bg-yellow-100 text-yellow-800 border-yellow-300',
            'Pemeriksaan' => 'bg-blue-100 text-blue-800 border-blue-300',
            'Pra-Karantina' => 'bg-orange-100 text-orange-800 border-orange-300',
            'Operasi' => 'bg-red-100 text-red-800 border-red-300',
            'Pasca-Karantina' => 'bg-purple-100 text-purple-800 border-purple-300',
            'Rawat Jalan' => 'bg-indigo-100 text-indigo-800 border-indigo-300',
            'Kritis' => 'bg-red-200 text-red-900 border-red-400',
            'Meninggal' => 'bg-gray-800 text-white border-gray-900',
            'Selesai' => 'bg-green-100 text-green-800 border-green-300',
            default => 'bg-gray-100 text-gray-800 border-gray-300',
        };
    }
}
