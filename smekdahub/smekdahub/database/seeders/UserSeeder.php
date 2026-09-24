<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name' => 'Admin Smekda',
            'email' => 'admin@smekda.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Akun Siswa (EMAIL: siswa@gmail.com)
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'siswa@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        // Akun Siswa 2
        User::create([
            'name' => 'Siti Rahayu',
            'email' => 'siti@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'siswa',
        ]);

        // Akun Orang Tua
        User::create([
            'name' => 'Pak Slamet (Ortu)',
            'email' => 'ortu@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'ortu',
        ]);

        // Akun Masyarakat
        User::create([
            'name' => 'Warga Budiman',
            'email' => 'masyarakat@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'masyarakat',
        ]);

        // Akun Guru (Opsional)
        User::create([
            'name' => 'Bu Guru Matematika',
            'email' => 'guru@gmail.com',
            'password' => Hash::make('password123'),
            'role' => 'masyarakat',
        ]);

        // Buat 5 akun siswa dummy
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => 'Siswa ' . $i,
                'email' => 'siswa' . $i . '@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'siswa',
            ]);
        }
    }
}