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
        'id_user',
        'tanggal_kunjungan',
        'keluhan',
        'diagnosis',
        'tindakan',
        'catatan',
        'total_biaya',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'datetime',
        'total_biaya' => 'decimal:2',
    ];

    // Relasi ke Patient
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'id_pasien');
    }

    // Relasi ke Doctor
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_dokter');
    }

    // Relasi ke Service
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_layanan');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
