<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RekamMedis;
use App\Models\Tindakan;
use App\Models\Obat;
use DB;

class HomeController extends Controller
{
    public function index()
    {
        // Jumlah kunjungan per bulan (pakai tanggal_periksa)
        $kunjunganPerBulan = RekamMedis::whereMonth('tanggal_periksa', now()->month)
                                ->whereYear('tanggal_periksa', now()->year)
                                ->count();

        // Jenis tindakan terbanyak (dari tabel pivot rekam_medis_tindakan)
        $tindakanTerbanyak = DB::table('rekam_medis_tindakan')
                                ->join('tindakans', 'rekam_medis_tindakan.tindakan_id', '=', 'tindakans.id')
                                ->select('tindakans.nama_tindakan', DB::raw('count(*) as total'))
                                ->groupBy('tindakans.nama_tindakan')
                                ->orderByDesc('total')
                                ->value('tindakans.nama_tindakan');

        // Obat yang paling sering diresepkan (dari tabel pivot rekam_medis_obat)
        $obatTerbanyak = DB::table('rekam_medis_obat')
                            ->join('obats', 'rekam_medis_obat.obat_id', '=', 'obats.id')
                            ->select('obats.nama_obat', DB::raw('count(*) as total'))
                            ->groupBy('obats.nama_obat')
                            ->orderByDesc('total')
                            ->value('obats.nama_obat');

        return view('home', [
            'kunjunganPerBulan' => $kunjunganPerBulan,
            'tindakanTerbanyak' => $tindakanTerbanyak,
            'obatTerbanyak' => $obatTerbanyak,
        ]);
    }
}
