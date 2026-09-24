<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

echo "=== DATA USER ===\n";
$users = \App\Models\User::all(['id', 'name', 'email', 'role']);
foreach ($users as $user) {
    echo "ID: $user->id | Nama: $user->name | Email: $user->email | Role: $user->role\n";
}

echo "\n=== DATA PELANGGAN ===\n";
$pelanggans = \App\Models\Pelanggan::with('user')->get();
foreach ($pelanggans as $pelanggan) {
    echo "ID: $pelanggan->id | Pelanggan: $pelanggan->nama | User: $pelanggan->user->name | Email: $pelanggan->email\n";
}
