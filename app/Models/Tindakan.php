<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tindakan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_tindakan', 'deskripsi', 'harga'
    ];

    // Relasi dengan Rekam Medis (many-to-many)
    public function rekamMedis()
    {
        return $this->belongsToMany(RekamMedis::class, 'rekam_medis_tindakan', 'tindakan_id', 'rekam_medis_id');
    }

    // Relasi dengan Tagihan
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
}

