<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\RekamMedis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class TagihanController extends Controller
{
    public function index()
    {
        $tagihans = Tagihan::with('rekamMedis.pasien')->latest()->paginate(10);
        return view('tagihan.index', compact('tagihans'));
    }

    public function create()
    {
        $rekamMedis = RekamMedis::with('pasien')->get();
        return view('tagihan.create', compact('rekamMedis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'tanggal_tagihan' => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,lunas',
            'metode_pembayaran' => 'required|in:tunai,transfer,kredit',
        ]);

        // Hitung total tagihan dari tindakan dan obat
        $totalTagihan = $this->hitungTotalTagihan($request->rekam_medis_id);

        Tagihan::create([
            'rekam_medis_id'    => $request->rekam_medis_id,
            'tanggal_tagihan'   => $request->tanggal_tagihan,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_tagihan'     => $totalTagihan,
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dibuat.');
    }

    public function edit(Tagihan $tagihan)
    {
        $rekamMedis = RekamMedis::with('pasien')->get();
        return view('tagihan.edit', compact('tagihan', 'rekamMedis'));
    }

    public function update(Request $request, Tagihan $tagihan)
    {
        $request->validate([
            'rekam_medis_id' => 'required|exists:rekam_medis,id',
            'tanggal_tagihan' => 'required|date',
            'status_pembayaran' => 'required|in:belum_bayar,lunas',
            'metode_pembayaran' => 'required|in:tunai,transfer,kredit',
        ]);

        $totalTagihan = $this->hitungTotalTagihan($request->rekam_medis_id);

        $tagihan->update([
            'rekam_medis_id'    => $request->rekam_medis_id,
            'tanggal_tagihan'   => $request->tanggal_tagihan,
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
            'total_tagihan'     => $totalTagihan,
        ]);

        return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        // Find the Tagihan by its ID
        $tagihan = Tagihan::findOrFail($id);
    
        // Attempt to delete the Tagihan
        try {
            $tagihan->delete();
    
            // Redirect back with success message
            return redirect()->route('tagihan.index')->with('success', 'Tagihan berhasil dihapus.');
        } catch (\Exception $e) {
            // If there is an error, redirect back with an error message
            return redirect()->route('tagihan.index')->with('error', 'Gagal menghapus tagihan. Coba lagi.');
        }
    }    

    private function hitungTotalTagihan($rekamMedisId)
    {
        $rekamMedis = RekamMedis::with(['tindakans', 'obats'])->findOrFail($rekamMedisId);

        $totalTindakan = $rekamMedis->tindakans->sum('harga');

        $totalObat = $rekamMedis->obats->sum('harga');

        return $totalTindakan + $totalObat;
    }

    public function cetak($id)
    {
        // Get the tagihan data
        $tagihan = Tagihan::findOrFail($id);

        // Load the view and pass data to it
        $pdf = PDF::loadView('tagihan.cetak', compact('tagihan'));

        // Stream the PDF to the browser (instead of downloading)
        return $pdf->stream('tagihan-' . $tagihan->id . '.pdf');
    }

}
