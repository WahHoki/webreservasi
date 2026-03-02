<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    protected $guarded = ['id'];

    // Relasi jika user adalah dokter
    public function doctorProfile(): HasOne
    {
        return $this->hasOne(Doctor::class);
    }

    // Relasi jika user adalah pasien
    public function reservations(): HasMany
    {
        return $this->hasMany(Reservation::class, 'patient_id');
    }
}