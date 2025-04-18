<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use Illuminate\Http\Request;

class PasienController extends Controller
{
    public function index()
    {
        $pasiens = Pasien::paginate(10);
        return view('pasien.index', compact('pasiens'));
    }

    public function create()
    {
        return view('pasien.create');
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'gol_darah' => 'required|string|max:3',
        ]);

        // Create the new Pasien record using the validated data
        Pasien::create([
            'nama' => $request->input('nama'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'no_telepon' => $request->input('no_telepon'),
            'gol_darah' => $request->input('gol_darah'),
        ]);

        // Redirect to the pasien index page with a success message
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil ditambahkan.');
    }

    public function edit(Pasien $pasien)
    {
        return view('pasien.edit', compact('pasien'));
    }

    public function update(Request $request, Pasien $pasien)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string|max:10',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'no_telepon' => 'required|string|max:15',
            'gol_darah' => 'required|string|max:3',
        ]);

        $pasien->update($request->all());
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil diupdate.');
    }

    public function destroy(Pasien $pasien)
    {
        $pasien->delete();
        return redirect()->route('pasien.index')->with('success', 'Pasien berhasil dihapus.');
    }
}
