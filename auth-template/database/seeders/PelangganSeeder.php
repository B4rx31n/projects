<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pelanggan untuk user dengan ID 2 (Super Amin)
        Pelanggan::create([
            'user_id' => 2,
            'nama' => 'PT Jaya Abadi',
            'email' => 'info@jayaabadi.com',
            'no_telepon' => '0812-3456-7890',
            'alamat' => 'Jl. Merdeka No. 123',
            'kota' => 'Jakarta',
            'provinsi' => 'DKI Jakarta',
            'kode_pos' => '12345',
        ]);

        Pelanggan::create([
            'user_id' => 2,
            'nama' => 'CV Bersama Makmur',
            'email' => 'contact@bersamamakmur.com',
            'no_telepon' => '0821-9876-5432',
            'alamat' => 'Jl. Sudirman No. 456',
            'kota' => 'Bandung',
            'provinsi' => 'Jawa Barat',
            'kode_pos' => '40123',
        ]);

        // Pelanggan untuk admin
        Pelanggan::create([
            'user_id' => 1,
            'nama' => 'Toko Elektronik Maju',
            'email' => 'toko@elektronik.com',
            'no_telepon' => '0811-1111-1111',
            'alamat' => 'Jl. Ahmad Yani No. 789',
            'kota' => 'Surabaya',
            'provinsi' => 'Jawa Timur',
            'kode_pos' => '60123',
        ]);
    }
}
