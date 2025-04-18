<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::paginate(10);
        return view('obat.index', compact('obats'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'expired_date' => 'required|date',
        ]);

        Obat::create($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'jenis' => 'required|string|max:255',
            'dosis' => 'required|string|max:255',
            'stok' => 'required|integer',
            'satuan' => 'required|string|max:50',
            'harga' => 'required|numeric',
            'expired_date' => 'required|date',
        ]);

        $obat->update($request->all());
        return redirect()->route('obat.index')->with('success', 'Obat berhasil diupdate.');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();
        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}
