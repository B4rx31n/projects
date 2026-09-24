<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Kategori
        \App\Models\Kategori::create(['nama_kategori' => 'Elektronik']);
        \App\Models\Kategori::create(['nama_kategori' => 'Pakaian']);
        \App\Models\Kategori::create(['nama_kategori' => 'Makanan']);
        
        // Produk
        \App\Models\Produk::create([
            'nama_barang' => 'Laptop',
            'kategori_id' => 1,
            'jumlah' => 5
        ]);
        
        \App\Models\Produk::create([
            'nama_barang' => 'Kaos',
            'kategori_id' => 2,
            'jumlah' => 20
        ]);
        
        \App\Models\Produk::create([
            'nama_barang' => 'Kopi',
            'kategori_id' => 3,
            'jumlah' => 50
        ]);
        
        // Supplier
        \App\Models\Supplier::create([
            'nama_supplier' => 'Supplier Jakarta',
            'kota' => 'Jakarta',
            'nomor_telepon' => '021-123456'
        ]);
        
        \App\Models\Supplier::create([
            'nama_supplier' => 'Supplier Bandung',
            'kota' => 'Bandung',
            'nomor_telepon' => '022-654321'
        ]);
    }
}