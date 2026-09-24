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
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->renameColumn('jumlah_pinjam', 'jumlah_kirim');
            $table->renameColumn('tanggal_pinjam', 'tanggal_kirim');
            $table->renameColumn('tanggal_kembali', 'tanggal_diterima');
        });
    }

    public function down(): void
    {
        Schema::table('pengirimans', function (Blueprint $table) {
            $table->renameColumn('jumlah_kirim', 'jumlah_pinjam');
            $table->renameColumn('tanggal_kirim', 'tanggal_pinjam');
            $table->renameColumn('tanggal_diterima', 'tanggal_kembali');
        });
    }
};
