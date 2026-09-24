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
        // Rename kolom anggota_id menjadi supplier_id
        Schema::table('pinjams', function (Blueprint $table) {
            $table->dropForeign(['anggota_id']);
            $table->renameColumn('anggota_id', 'supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });

        // Rename tabel pinjams menjadi pengirimans
        Schema::rename('pinjams', 'pengirimans');
    }

    public function down(): void
    {
        // Reverse: rename tabel pengirimans menjadi pinjams
        Schema::rename('pengirimans', 'pinjams');

        // Reverse: rename kolom supplier_id menjadi anggota_id
        Schema::table('pinjams', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
            $table->renameColumn('supplier_id', 'anggota_id');
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
        });
    }
};
