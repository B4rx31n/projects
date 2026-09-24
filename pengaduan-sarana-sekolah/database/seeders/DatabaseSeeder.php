<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun demo (untuk ujian/praktik)
        User::query()->updateOrCreate(
            ['email' => 'admin@demo.test'],
            [
                'name' => 'Admin Sarpras',
                'password' => Hash::make('password'),
                'role' => User::ROLE_ADMIN,
            ]
        );

        User::query()->updateOrCreate(
            ['email' => 'siswa@demo.test'],
            [
                'name' => 'Siswa Demo',
                'password' => Hash::make('password'),
                'role' => User::ROLE_SISWA,
            ]
        );

        // Master kategori sarana
        $kategori = [
            'Ruang Kelas',
            'Toilet',
            'Laboratorium',
            'Perpustakaan',
            'Lapangan/Olahraga',
            'Listrik/Internet',
            'Lainnya',
        ];

        foreach ($kategori as $name) {
            Category::query()->updateOrCreate(['name' => $name], ['name' => $name]);
        }
    }
}
