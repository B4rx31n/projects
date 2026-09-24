<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Stepen;

class StepenSeeder extends Seeder
{
    public function run(): void
    {
        Stepen::create([
            'nama'  => 'Laptop Asus',
            'harga' => 12000000,
            'stok'  => 5
        ]);

        Stepen::create([
            'nama'  => 'Mouse Logitech',
            'harga' => 250000,
            'stok'  => 20
        ]);

        Stepen::create([
            'nama'  => 'Keyboard Mechanical',
            'harga' => 750000,
            'stok'  => 10
        ]);
    }
}
