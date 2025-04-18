<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekamMedis extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id', 'pegawai_id', 'tanggal_periksa', 'keluhan', 'diagnosa', 'catatan'
    ];

    // Relasi dengan Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // Relasi dengan Pegawai
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class);
    }

    // Relasi dengan Tindakan (many-to-many)
    public function tindakans()
    {
        return $this->belongsToMany(Tindakan::class, 'rekam_medis_tindakan', 'rekam_medis_id', 'tindakan_id');
    }

    // Relasi dengan Obat (many-to-many dengan pivot untuk jumlah)
    public function obats()
    {
        return $this->belongsToMany(Obat::class, 'rekam_medis_obat', 'rekam_medis_id', 'obat_id');
    }
}


