<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update enum status untuk pengiriman
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE pengirimans MODIFY COLUMN status ENUM('dikirim', 'diterima', 'tertunda') DEFAULT 'dikirim'");
    }

    public function down(): void
    {
        // Revert enum status ke peminjaman
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE pengirimans MODIFY COLUMN status ENUM('dipinjam', 'dikembalikan', 'terlambat') DEFAULT 'dipinjam'");
    }
};
