<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('judul');
            $table->text('isi_laporan');
            $table->enum('prioritas', ['tinggi', 'sedang', 'rendah'])->default('rendah');
            $table->enum('status', ['pending', 'proses', 'selesai'])->default('pending');
            $table->timestamps();
            $table->index(['prioritas', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('laporans');
    }
};