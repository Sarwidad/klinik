<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat', 'jenis', 'dosis', 'stok', 'satuan', 'harga', 'expired_date'
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
