<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PolyclinicController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ScheduleController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Rute Dashboard Utama (Controller yang akan membagi tampilan)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// BUNGKUS UTAMA: Semua rute di dalam ini wajib LOGIN ('auth')
Route::middleware('auth')->group(function () {
    
    // Rute Profil Bawaan Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // --------------------------------------------------------
    // HANYA BISA DIAKSES OLEH PASIEN
    // --------------------------------------------------------
    Route::middleware(['role:patient'])->group(function () {
        Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
        Route::post('/get-doctors', [ReservationController::class, 'getDoctors'])->name('api.get_doctors');
        Route::post('/get-schedules', [ReservationController::class, 'getSchedules'])->name('api.get_schedules');
        Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');
    });

    // --------------------------------------------------------
    // HANYA BISA DIAKSES OLEH ADMIN
    // --------------------------------------------------------
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('polyclinics', PolyclinicController::class);
        Route::resource('doctors', DoctorController::class);
        Route::resource('schedules', ScheduleController::class); 
    });

});

require __DIR__.'/auth.php';