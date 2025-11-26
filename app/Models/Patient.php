<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'nama_hewan',
        'jenis_hewan',
        'ras',
        'umur_hewan',
        'jenis_kelamin',
        'riwayat_perawatan',
        'status',
    ];
     // Relasi ke User (pemilik hewan)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Visits
    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_pasien');
    }
}
