<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'nama' => 'Semen Tiga Roda',
            'stok' => 50,
            'harga' => 65000
        ]);

        Produk::create([
            'nama' => 'Pasir Bangunan',
            'stok' => 100,
            'harga' => 150000
        ]);

        Produk::create([
            'nama' => 'Batu Bata Merah',
            'stok' => 500,
            'harga' => 800
        ]);

        Produk::create([
            'nama' => 'Semen Gresik',
            'stok' => 40,
            'harga' => 63000
        ]);

        Produk::create([
            'nama' => 'Cat Tembok Dulux',
            'stok' => 30,
            'harga' => 180000
        ]);
    }
}
