<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable =[
        'nama',
        'spesialis',
        'telepon',
        'email',
        'alamat',
        'is_active',
    ];
    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relasi ke Visits
    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_dokter');
    }
}
