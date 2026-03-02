<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return view('dashboard.admin');
            
        } elseif ($user->role === 'doctor') {
            return view('dashboard.doctor');
            
        } else {
            // Logika khusus untuk Dashboard Pasien
            // Ambil 1 jadwal reservasi terdekat yang statusnya masih 'pending'
            $nextReservation = Reservation::with(['schedule.doctor.user', 'schedule.doctor.polyclinic'])
                ->where('patient_id', $user->id)
                ->where('status', 'pending')
                ->whereDate('reservation_date', '>=', now()) // Hanya jadwal hari ini atau ke depan
                ->orderBy('reservation_date', 'asc')
                ->first();

            return view('dashboard.patient', compact('nextReservation'));
        }
    }
}