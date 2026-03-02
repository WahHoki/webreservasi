<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Polyclinic;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Halaman utama form reservasi & Riwayat.
     */
    public function index()
    {
        // 1. Ambil data poli untuk dropdown
        $polyclinics = Polyclinic::all();

        // 2. (BARU) Ambil data riwayat reservasi user yang sedang login
        // Kita menggunakan 'with' agar query efisien (Eager Loading) mengambil nama dokter & poli
        $reservations = Reservation::with(['schedule.doctor.user', 'schedule.doctor.polyclinic'])
                        ->where('patient_id', auth()->id()) // Hanya ambil punya user yang login
                        ->orderBy('reservation_date', 'desc') // Urutkan dari yang terbaru
                        ->get();

        // Kirim kedua variabel ke view
        return view('reservation.index', compact('polyclinics', 'reservations'));
    }

    /**
     * API untuk AJAX: Mengambil dokter berdasarkan poli.
     */
    public function getDoctors(Request $request)
    {
        $request->validate(['polyclinic_id' => 'required|exists:polyclinics,id']);

        $doctors = Doctor::with('user')
                    ->where('polyclinic_id', $request->polyclinic_id)
                    ->get();

        $formattedDoctors = $doctors->map(function ($doctor) {
            return [
                'id' => $doctor->id,
                'name' => $doctor->user->name,
                'sip' => $doctor->sip
            ];
        });

        return response()->json($formattedDoctors);
    }

    /**
     * API untuk AJAX: Mengambil jadwal berdasarkan dokter.
     */
    public function getSchedules(Request $request)
    {
        $request->validate(['doctor_id' => 'required|exists:doctors,id']);

        $schedules = Schedule::where('doctor_id', $request->doctor_id)->get();

        return response()->json($schedules);
    }

    /**
     * Proses simpan reservasi.
     */
    public function store(Request $request)
    {
        $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'reservation_date' => 'required|date|after_or_equal:today',
        ]);

        DB::beginTransaction();

        try {
            // 1. Hitung nomor antrean
            $existingReservations = Reservation::where('schedule_id', $request->schedule_id)
                                    ->whereDate('reservation_date', $request->reservation_date)
                                    ->count();
            
            $queueNumber = $existingReservations + 1;

            // 2. Cek kuota
            $schedule = Schedule::find($request->schedule_id);
            if ($queueNumber > $schedule->quota) {
                return response()->json(['message' => 'Kuota penuh untuk tanggal ini!'], 400);
            }

            // 3. Simpan data
            $reservation = Reservation::create([
                'patient_id' => auth()->id(),
                'schedule_id' => $request->schedule_id,
                'reservation_date' => $request->reservation_date,
                'queue_number' => $queueNumber,
                'status' => 'pending'
            ]);

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Reservasi berhasil dibuat!',
                'data' => $reservation
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()], 500);
        }
    }
}