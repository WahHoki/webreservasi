<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        // Ambil data jadwal beserta relasi dokter (dan user untuk nama dokternya)
        $schedules = Schedule::with(['doctor.user', 'doctor.polyclinic'])->orderBy('day')->get();
        
        // Ambil data dokter untuk pilihan di dropdown form
        $doctors = Doctor::with(['user', 'polyclinic'])->get();

        return view('schedule.index', compact('schedules', 'doctors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
            'quota' => 'required|integer|min:1'
        ]);

        Schedule::create([
            'doctor_id' => $request->doctor_id,
            'day' => $request->day,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'quota' => $request->quota
        ]);

        return redirect()->route('schedules.index')->with('success', 'Jadwal praktik berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedules.index')->with('success', 'Jadwal praktik berhasil dihapus!');
    }
}