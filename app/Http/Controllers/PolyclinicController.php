<?php

namespace App\Http\Controllers;

use App\Models\Polyclinic;
use Illuminate\Http\Request;

class PolyclinicController extends Controller
{
    // Menampilkan daftar Poliklinik
    public function index()
    {
        $polyclinics = Polyclinic::all();
        return view('polyclinic.index', compact('polyclinics'));
    }

    // Menyimpan Poliklinik baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);

        Polyclinic::create([
            'name' => $request->name,
            'description' => $request->description
        ]);

        return redirect()->route('polyclinics.index')->with('success', 'Data Poliklinik berhasil ditambahkan!');
    }

    // Menghapus Poliklinik
    public function destroy($id)
    {
        $polyclinic = Polyclinic::findOrFail($id);
        $polyclinic->delete();

        return redirect()->route('polyclinics.index')->with('success', 'Data Poliklinik berhasil dihapus!');
    }
}