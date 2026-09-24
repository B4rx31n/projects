<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$pelanggans = [
    [
        'user_id' => 2,
        'nama' => 'PT Citra Jaya',
        'email' => 'admin@citrajaya.com',
        'no_telepon' => '0812-1234-5678',
        'alamat' => 'Jl. Gatot Subroto No. 10',
        'kota' => 'Medan',
        'provinsi' => 'Sumatera Utara',
        'kode_pos' => '20123',
    ],
    [
        'user_id' => 2,
        'nama' => 'CV Maju Bersama',
        'email' => 'info@majubersama.com',
        'no_telepon' => '0813-9876-5432',
        'alamat' => 'Jl. Dipati Ukur No. 45',
        'kota' => 'Bandung',
        'provinsi' => 'Jawa Barat',
        'kode_pos' => '40135',
    ],
    [
        'user_id' => 2,
        'nama' => 'Toko Ritel Sentosa',
        'email' => 'contact@sentosamall.com',
        'no_telepon' => '0814-5555-6666',
        'alamat' => 'Jl. Pemuda No. 99',
        'kota' => 'Semarang',
        'provinsi' => 'Jawa Tengah',
        'kode_pos' => '50132',
    ],
    [
        'user_id' => 2,
        'nama' => 'Industri Garmen Sukses',
        'email' => 'sales@garmensuccessindo.com',
        'no_telepon' => '0815-7777-8888',
        'alamat' => 'Jl. Pemuda No. 50',
        'kota' => 'Yogyakarta',
        'provinsi' => 'DI Yogyakarta',
        'kode_pos' => '55123',
    ],
    [
        'user_id' => 2,
        'nama' => 'PT Ekspor Impor Nusantara',
        'email' => 'export@nusantara.co.id',
        'no_telepon' => '0816-9999-0000',
        'alamat' => 'Jl. Brigjend Katamso No. 88',
        'kota' => 'Makassar',
        'provinsi' => 'Sulawesi Selatan',
        'kode_pos' => '90134',
    ],
];

foreach ($pelanggans as $p) {
    \App\Models\Pelanggan::create($p);
}

echo "✅ Data berhasil ditambahkan!\n";
echo "Total data pelanggan untuk user: " . \App\Models\User::find(2)->pelanggans->count() . "\n";
