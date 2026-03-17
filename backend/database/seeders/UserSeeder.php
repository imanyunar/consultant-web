<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@appoint.ease',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'super_admin',
        ]);

        $psychologistUser = \App\Models\User::create([
            'name' => 'Psikolog Utama',
            'email' => 'psikolog@appoint.ease',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'psychologist',
        ]);

        \App\Models\Psychologist::create([
            'user_id' => $psychologistUser->id,
            'name' => 'Psikolog Utama',
            'specialization' => 'Psikologi Klinis',
            'bio' => 'Berpengalaman menangani berbagai masalah kecemasan dan depresi.',
            'phone' => '08122334455',
            'email' => 'psikolog@appoint.ease',
            'consultation_fee' => 150000.00,
        ]);

        $patientUser = \App\Models\User::create([
            'name' => 'Pasien Contoh',
            'email' => 'pasien@appoint.ease',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'patient',
        ]);

        \App\Models\Patient::create([
            'user_id' => $patientUser->id,
            'name' => 'Pasien Contoh',
            'email' => 'pasien@appoint.ease',
            'phone' => '08123456789',
            'birth_date' => '1995-05-15',
        ]);
    }
}
