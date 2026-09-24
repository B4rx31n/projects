<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Test;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        Test::create([
            'nama'  => 'Laptop Asus',
            'harga' => 12000000,
            'stok'  => 5
        ]);

        Test::create([
            'nama'  => 'Mouse Logitech',
            'harga' => 250000,
            'stok'  => 20
        ]);

        Test::create([
            'nama'  => 'Keyboard Mechanical',
            'harga' => 750000,
            'stok'  => 10
        ]);
        Test::create([
            'nama'  => 'Lmonitor Samsung',
            'harga' => 1120000,
            'stok'  => 15
        ]);
        Test::create([
            'nama'  => 'Mouse Pad',
            'harga' => 14000,
            'stok'  => 8
        ]);
        Test::create([
            'nama'  => 'computer Acer',
            'harga' => 134000000,
            'stok'  => 7
        ]);
        Test::create([
            'nama'  => 'headphone Sony',
            'harga' => 12230000,
            'stok'  => 54
        ]);
        Test::create([
            'nama'  => 'Laptop Thinkpad',
            'harga' => 122300000,
            'stok'  => 32
        ]);

    }
}
