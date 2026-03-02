<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Polyclinic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function index()
    {
        // Ambil data dokter beserta relasi nama user dan nama poli
        $doctors = Doctor::with(['user', 'polyclinic'])->get();
        
        // Ambil data poli untuk mengisi menu dropdown di form
        $polyclinics = Polyclinic::all();

        return view('doctor.index', compact('doctors', 'polyclinics'));
    }

    public function store(Request $request)
    {
        // 1. Validasi input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'polyclinic_id' => 'required|exists:polyclinics,id',
            'sip' => 'required|string|unique:doctors'
        ]);

        // 2. Gunakan DB Transaction agar aman
        DB::beginTransaction();
        try {
            // A. Buat akun login untuk dokter
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
            ]);

            // B. Buat profil dokter yang terhubung ke user dan poli
            Doctor::create([
                'user_id' => $user->id,
                'polyclinic_id' => $request->polyclinic_id,
                'sip' => $request->sip,
            ]);

            DB::commit(); // Simpan permanen jika sukses
            return redirect()->route('doctors.index')->with('success', 'Data Dokter beserta akun login berhasil ditambahkan!');
            
        } catch (\Exception $e) {
            DB::rollBack(); // Batalkan semua jika ada error
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $doctor = Doctor::findOrFail($id);
        
        // Karena di migration kita set 'cascadeOnDelete', 
        // menghapus akun User akan otomatis menghapus profil Doctor dan jadwalnya.
        $doctor->user->delete();

        return redirect()->route('doctors.index')->with('success', 'Data Dokter berhasil dihapus!');
    }
}