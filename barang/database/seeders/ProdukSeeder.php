<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        Produk::create([
            'nama'  => 'Laptop Asus',
            'harga' => 12000000,
            'stok'  => 5
        ]);

        Produk::create([
            'nama'  => 'Mouse Logitech',
            'harga' => 250000,
            'stok'  => 20
        ]);

        Produk::create([
            'nama'  => 'Keyboard Mechanical',
            'harga' => 750000,
            'stok'  => 10
        ]);
    }
}
