<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Product::create([
            'name' => 'Laptop',
            'price' => 15000000,
            'quantity' => 10,
        ]);

        Product::create([
            'name' => 'Mouse',
            'price' => 150000,
            'quantity' => 50,
        ]);

        Product::create([
            'name' => 'Keyboard',
            'price' => 300000,
            'quantity' => 30,
        ]);

        Product::create([
            'name' => 'Monitor',
            'price' => 2500000,
            'quantity' => 15,
        ]);

        Product::create([
            'name' => 'Printer',
            'price' => 1200000,
            'quantity' => 8,
        ]);
    }
}
