<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tanggapans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained()->onDelete('cascade');
            $table->text('isi_tanggapan');
            $table->foreignId('admin_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
            
            $table->unique('laporan_id'); // Satu laporan hanya punya satu tanggapan
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tanggapans');
    }
};