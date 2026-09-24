<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tester;

class TesterSeeder extends Seeder
{
    public function run(): void
    {
        Tester::create([
            'nama'  => 'Laptop Asus',
            'harga' => 12000000,
            'stok'  => 5
        ]);

        Tester::create([
            'nama'  => 'Mouse Logitech',
            'harga' => 250000,
            'stok'  => 20
        ]);

        Tester::create([
            'nama'  => 'Keyboard Mechanical',
            'harga' => 750000,
            'stok'  => 10
        ]);
    }
}
