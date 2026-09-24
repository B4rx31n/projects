<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$users = \App\Models\User::all(['id', 'name', 'email', 'role']);
echo "=== DAFTAR SEMUA USER ===\n\n";
foreach ($users as $user) {
    echo "ID: " . $user->id . " | Nama: " . $user->name . " | Email: " . $user->email . " | Role: " . $user->role . "\n";
}
