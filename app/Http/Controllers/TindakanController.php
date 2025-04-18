<?php

namespace App\Http\Controllers;

use App\Models\Tindakan;
use Illuminate\Http\Request;

class TindakanController extends Controller
{
    public function index()
    {
        $tindakans = Tindakan::paginate(10);
        return view('tindakan.index', compact('tindakans'));
    }

    public function create()
    {
        return view('tindakan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'harga' => 'required|numeric',
        ]);

        Tindakan::create($request->all());
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function edit(Tindakan $tindakan)
    {
        return view('tindakan.edit', compact('tindakan'));
    }

    public function update(Request $request, Tindakan $tindakan)
    {
        $request->validate([
            'nama_tindakan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:255',
            'harga' => 'required|numeric',
        ]);

        $tindakan->update($request->all());
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil diupdate.');
    }

    public function destroy(Tindakan $tindakan)
    {
        $tindakan->delete();
        return redirect()->route('tindakan.index')->with('success', 'Tindakan berhasil dihapus.');
    }
}
