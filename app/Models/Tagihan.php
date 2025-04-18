<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;

    protected $fillable = [
        'rekam_medis_id', 'tanggal_tagihan', 'status_pembayaran', 'metode_pembayaran', 'total_tagihan'
    ];

    // Relasi dengan RekamMedis
    public function rekamMedis()
    {
        return $this->belongsTo(RekamMedis::class);
    }

    // Relasi dengan Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    // Relasi dengan Tindakan
    public function tindakan()
    {
        return $this->belongsTo(Tindakan::class);
    }

    // Relasi dengan Obat
    public function obat()
    {
        return $this->belongsTo(Obat::class);
    }

    // Fungsi untuk menghitung total tagihan
    public function hitungTotalTagihan()
    {
        $tindakanHarga = $this->tindakan ? $this->tindakan->harga : 0;
        $obatHarga = $this->obat ? $this->obat->harga : 0;

        return $tindakanHarga + $obatHarga;
    }

    public function cetak($id)
    {
        $tagihan = Tagihan::findOrFail($id);
        
        // Misalnya menggunakan view untuk mencetak tagihan
        $pdf = PDF::loadView('tagihan.cetak', compact('tagihan'));

        return $pdf->download('tagihan-' . $tagihan->id . '.pdf'); // Men-download PDF
        // atau bisa return view('tagihan.cetak', compact('tagihan')); jika hanya ingin menampilkan di browser
    }

}
