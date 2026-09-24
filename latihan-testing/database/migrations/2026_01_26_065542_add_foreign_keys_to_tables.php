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
        // Foreign key kategori_id di produks sudah ada dari migration sebelumnya

        // Tambahkan foreign key ke tabel suppliers
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
        });

        // Tambahkan foreign key ke tabel anggota
        Schema::table('anggota', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        // Hapus foreign key dari tabel anggota
        Schema::table('anggota', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        // Hapus foreign key dari tabel suppliers
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn('created_by');
        });

        // Foreign key kategori_id di produks tidak dihapus karena sudah ada sebelumnya
    }
};
