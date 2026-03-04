<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
// Pastikan DoctorController di-import
use App\Http\Controllers\DoctorController;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.admin');
            
        } elseif ($user->role === 'doctor') {
            // Memanggil fungsi dashboard() yang mengirim $todayReservations
            // JANGAN panggil allReservations() di sini karena akan menyebabkan error di view dashboard utama
            return app(DoctorController::class)->dashboard();
            
        } else {
            // Logika untuk Dashboard Pasien
            $nextReservation = Reservation::with(['schedule.doctor.user', 'schedule.doctor.polyclinic'])
                ->where('patient_id', $user->id)
                ->whereIn('status', ['pending', 'in_progress']) // Tambahkan in_progress agar pasien tahu jika sedang diperiksa
                ->whereDate('reservation_date', '>=', now()->toDateString())
                ->orderBy('reservation_date', 'asc')
                ->first();

            return view('dashboard.patient', compact('nextReservation'));
        }
    }
}