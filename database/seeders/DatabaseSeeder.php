<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Polyclinic;
use App\Models\Doctor;
use App\Models\Schedule;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Data Poliklinik
        $poliUmum = Polyclinic::create([
            'name' => 'Poli Umum',
            'description' => 'Pelayanan kesehatan umum dan keluhan dasar.'
        ]);

        $poliGigi = Polyclinic::create([
            'name' => 'Poli Gigi',
            'description' => 'Pelayanan kesehatan gigi, gusi, dan mulut.'
        ]);

        // 2. Buat Akun Pasien (Untuk kamu gunakan saat testing login)
        $patient = User::create([
            'name' => 'Pasien Testing',
            'email' => 'pasien@test.com',
            'password' => Hash::make('password'), // Password login: password
            'role' => 'patient',
            'phone' => '081234567890'
        ]);

        // 3. Buat Akun Dokter
        $doc1User = User::create([
            'name' => 'Dr. Budi Santoso',
            'email' => 'budi@test.com',
            'password' => Hash::make('password'),
            'role' => 'doctor'
        ]);

        $doc2User = User::create([
            'name' => 'Drg. Siti Aminah',
            'email' => 'siti@test.com',
            'password' => Hash::make('password'),
            'role' => 'doctor'
        ]);

        // 4. Hubungkan Dokter dengan Poliklinik (Buat Profil Dokter)
        $doctor1 = Doctor::create([
            'user_id' => $doc1User->id,
            'polyclinic_id' => $poliUmum->id,
            'sip' => 'SIP-UMUM-001'
        ]);

        $doctor2 = Doctor::create([
            'user_id' => $doc2User->id,
            'polyclinic_id' => $poliGigi->id,
            'sip' => 'SIP-GIGI-002'
        ]);

        // 5. Buat Jadwal Praktik Dokter
        // Jadwal Dr. Budi
        Schedule::create([
            'doctor_id' => $doctor1->id,
            'day' => 'Senin',
            'start_time' => '08:00:00',
            'end_time' => '12:00:00',
            'quota' => 20
        ]);
        Schedule::create([
            'doctor_id' => $doctor1->id,
            'day' => 'Rabu',
            'start_time' => '08:00:00',
            'end_time' => '12:00:00',
            'quota' => 20
        ]);

        // Jadwal Drg. Siti
        Schedule::create([
            'doctor_id' => $doctor2->id,
            'day' => 'Selasa',
            'start_time' => '13:00:00',
            'end_time' => '16:00:00',
            'quota' => 15
        ]);
    }
}