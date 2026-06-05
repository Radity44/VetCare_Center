<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = [
        'patient_id',
        'id_dokter',
        'id_layanan',
        'tanggal_kunjungan',
        'keluhan',
        'diagnosis',
        'tindakan',
        'catatan',
        'total_biaya',
        'status_visit',
    ];

    protected $casts = [
        'tanggal_kunjungan' => 'date',
        'total_biaya' => 'decimal:2',
    ];

    /**
     * ✅ RELASI: Kunjungan belong to Pasien (Many to One)
     */
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    /**
     * ✅ RELASI: Kunjungan belong to Dokter
     */
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'id_dokter', 'id');
    }

    /**
     * ✅ RELASI: Kunjungan belong to Layanan
     */
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_layanan', 'id');
    }
}
