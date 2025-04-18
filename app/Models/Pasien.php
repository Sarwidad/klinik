<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'no_telepon', 'gol_darah'
    ];

    // Relasi dengan RekamMedis
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }

    // Relasi dengan Tagihan
    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }
}

