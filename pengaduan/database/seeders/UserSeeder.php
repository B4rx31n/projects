<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Buat akun admin
        User::create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@example.com',  // Email untuk login
            'password' => Hash::make('password'),  // Password: 'password' (ganti jika perlu)
            'role' => 'admin',
        ]);

        // Buat akun siswa (opsional, untuk testing)
        User::create([
            'name' => 'Siswa Contoh',
            'email' => 'siswa@example.com',  // Email untuk login sebagai siswa
            'password' => Hash::make('password'),  // Password: 'password'
            'role' => 'siswa',
        ]);
    }
}