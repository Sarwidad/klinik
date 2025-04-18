<?php

namespace App\Http\Controllers;

use App\Models\RekamMedis;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Tindakan;
use App\Models\Obat;
use Illuminate\Http\Request;
use PDF;

class RekamMedisController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with([
            'pasien:id,nama',
            'pegawai:id,nama',
            'tindakans:id,nama_tindakan',
            'obats:id,nama_obat'
        ])->latest()->paginate(10);
    
        return view('rekam_medis.index', compact('rekamMedis'));
    }    

    public function create()
    {
        $pasiens = Pasien::all();
        $pegawais = Pegawai::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();

        return view('rekam_medis.create', compact('pasiens', 'pegawais', 'tindakans', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'tanggal_periksa' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'catatan' => 'nullable|string',
            'tindakan_id' => 'required|array', // validasi array
            'obat_id' => 'required|array', // validasi array
        ]);

        // Membuat Rekam Medis baru
        $rekamMedis = RekamMedis::create([
            'pasien_id' => $request->pasien_id,
            'pegawai_id' => $request->pegawai_id,
            'tanggal_periksa' => $request->tanggal_periksa,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'catatan' => $request->catatan,
        ]);
        
        $rekamMedis->tindakans()->attach($request->tindakan_id); // array
        $rekamMedis->obats()->attach($request->obat_id); // array atau bisa diubah jadi array dengan jumlah        

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::findOrFail($id); // Find the existing RekamMedis
        $pasiens = Pasien::all();
        $pegawais = Pegawai::all();
        $tindakans = Tindakan::all();
        $obats = Obat::all();

        return view('rekam_medis.edit', compact('rekamMedis', 'pasiens', 'pegawais', 'tindakans', 'obats'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pasien_id' => 'required|exists:pasiens,id',
            'pegawai_id' => 'required|exists:pegawais,id',
            'tanggal_periksa' => 'required|date',
            'keluhan' => 'required|string',
            'diagnosa' => 'required|string',
            'catatan' => 'nullable|string',
            'tindakan_id' => 'required|array', // validasi array
            'obat_id' => 'required|array', // validasi array
        ]);

        // Find the existing Rekam Medis and update
        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update([
            'pasien_id' => $request->pasien_id,
            'pegawai_id' => $request->pegawai_id,
            'tanggal_periksa' => $request->tanggal_periksa,
            'keluhan' => $request->keluhan,
            'diagnosa' => $request->diagnosa,
            'catatan' => $request->catatan,
        ]);
        
        // Update the relationships
        $rekamMedis->tindakans()->sync($request->tindakan_id); // sync will remove existing relationships and add new ones
        $rekamMedis->obats()->sync($request->obat_id); // same as above

        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil diperbarui.');
    }

    public function destroy(RekamMedis $rekamMedi)
    {
        $rekamMedi->delete();
        return redirect()->route('rekam_medis.index')->with('success', 'Rekam medis berhasil dihapus.');
    }

    public function cetak($id)
    {
        // Ambil data rekam medis beserta relasi
        $rekam = RekamMedis::with(['pasien', 'pegawai', 'tindakans', 'obats'])->findOrFail($id);

        // Generate PDF dari view
        $pdf = PDF::loadView('rekam_medis.cetak', compact('rekam'));

        // Tampilkan PDF di browser tanpa mendownload
        return $pdf->stream('rekam-medis-' . $rekam->id . '.pdf');
    }

}
