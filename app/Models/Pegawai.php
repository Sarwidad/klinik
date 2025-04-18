<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'no_telepon', 'jabatan'
    ];

    // Relasi dengan RekamMedis
    public function rekamMedis()
    {
        return $this->hasMany(RekamMedis::class);
    }
}

