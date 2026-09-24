<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Cek kolom yang ada
        $columns = DB::select('SHOW COLUMNS FROM users');
        $columnNames = array_column($columns, 'Field');
        
        echo "Columns in users table: " . implode(', ', $columnNames) . "\n";
        
        // Jika tidak ada kolom 'kota', tambahkan
        if (!in_array('kota', $columnNames)) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('kota')->nullable()->after('name');
            });
            echo "Added 'kota' column\n";
        } else {
            echo "'kota' column already exists\n";
        }
        
        // Pastikan kolom 'name' ada (bukan 'nama')
        if (!in_array('name', $columnNames) && in_array('nama', $columnNames)) {
            DB::statement('ALTER TABLE users CHANGE nama name VARCHAR(255)');
            echo "Renamed 'nama' to 'name'\n";
        }
    }

    public function down(): void
    {
        // Optional rollback
        Schema::table('users', function (Blueprint $table) {
            // Tidak perlu rollback karena hanya mengecek
        });
    }
};