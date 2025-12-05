<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_layanan',
        'deskripsi',
        'harga',
        'kategori',
        'durasi',
        'is_active',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    // Relasi ke Visits
    // public function visits()
    // {
    //     return $this->hasMany(Visit::class, 'id_layanan');
    // }
    public function visits()
    {
        return $this->hasMany(Visit::class, 'id_layanan');
    }
    


}
