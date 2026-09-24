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
    Schema::table('suppliers', function (Blueprint $table) {
        $table->string('nama_barang')->after('contact_person');
        $table->integer('jumlah_pasokan')->after('nama_barang');
    });
}

public function down(): void
{
    Schema::table('suppliers', function (Blueprint $table) {
        $table->dropColumn(['nama_barang', 'jumlah_pasokan']);
    });
}

};
