<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'id_layanan',
        'tanggal_kunjungan',
        'keluhan',
        'diagnosis',
        'tindakan',
        'catatan',
        'total_biaya',
    ];

        // ✅ TAMBAHKAN INI - Cast tanggal_kunjungan ke datetime
    protected $casts = [
        'tanggal_kunjungan' => 'datetime',
        'total_biaya' => 'decimal:2',
    ];

    // ❌ HAPUS relasi ke User
    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'id_user');
    // }

    // ✅ Relasi lain tetap ada
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_pasien');
    }

    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_dokter');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'id_layanan');
    }
}
