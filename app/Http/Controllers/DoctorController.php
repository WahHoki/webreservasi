<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use App\Models\Reservation;
use App\Models\Schedule;
use App\Models\Polyclinic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DoctorController extends Controller
{
    // Dashboard Ringkas (Halaman Utama Dokter)
// ... di dalam class DoctorController ...

// UNTUK HALAMAN: /doctor/dashboard (Hari Ini)
    public function dashboard()
    {
        $today = Carbon::today();
        $doctor = Doctor::where('user_id', Auth::id())->first();

        if (!$doctor) {
            return redirect('/')->with('error', 'Profil dokter tidak ditemukan.');
        }

        $todayReservations = Reservation::with(['patient', 'schedule'])
            ->whereHas('schedule', function($query) use ($doctor) {
                $query->where('doctor_id', $doctor->id);
            })
            ->whereDate('reservation_date', $today)
            ->orderBy('queue_number', 'asc')
            ->get();

        // Statistik harian
        $todayPatients = $todayReservations->count();
        $waitingCount  = $todayReservations->where('status', 'pending')->count();
        $doneCount     = $todayReservations->where('status', 'completed')->count();
        $scheduleCount = Schedule::where('doctor_id', $doctor->id)
            ->where('day', $today->isoFormat('dddd')) 
            ->count();

        return view('dashboard.doctor', compact(
            'todayReservations', 'todayPatients', 
            'waitingCount', 'doneCount', 'scheduleCount'
        ));
    }

    // UNTUK HALAMAN: /doctor/all-patients (Semua Riwayat)
    public function allReservations(Request $request)
    {
        $doctor = Doctor::where('user_id', Auth::id())->first();
        
        $query = Reservation::with(['patient', 'schedule'])
            ->whereHas('schedule', function($q) use ($doctor) {
                $q->where('doctor_id', $doctor->id);
            });

        if ($request->filled('search')) {
            $searchTerm = $request->search;
            $query->whereHas('patient', function($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Variabel ini HARUS sama dengan yang dipanggil di Blade
        $allReservations = $query->orderBy('reservation_date', 'desc')->paginate(10);

        return view('dashboard.doctor_all_reservations', compact('allReservations'));
    }

    // Update Status Pasien (Pending -> In Progress -> Completed)
    public function updateStatus(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->update(['status' => $request->status]);
        return back()->with('success', 'Status berhasil diperbarui!');
    }

    // --- Fungsi Admin (CRUD Dokter) ---
    public function index() {
        $doctors = Doctor::with(['user', 'polyclinic'])->get();
        $polyclinics = Polyclinic::all();
        return view('doctor.index', compact('doctors', 'polyclinics'));
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|min:8',
            'polyclinic_id' => 'required|exists:polyclinics,id',
            'sip' => 'required|unique:doctors'
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => 'doctor',
            ]);
            Doctor::create([
                'user_id' => $user->id,
                'polyclinic_id' => $request->polyclinic_id,
                'sip' => $request->sip,
            ]);
        });
        return redirect()->route('doctors.index')->with('success', 'Dokter berhasil ditambah.');
    }

    public function destroy($id) {
        $doctor = Doctor::findOrFail($id);
        $doctor->user->delete();
        return redirect()->route('doctors.index')->with('success', 'Dokter dihapus.');
    }
}