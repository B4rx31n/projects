<?php

use App\Models\Aspiration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspirations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->restrictOnDelete();

            $table->string('title', 150);
            $table->text('description');
            $table->string('location', 150)->nullable();
            $table->string('photo_path')->nullable();

            $table->string('status', 20)->default(Aspiration::STATUS_BARU);
            $table->unsignedTinyInteger('progress_percent')->default(0);

            $table->timestamps();

            $table->index(['status', 'created_at']);
            $table->index(['category_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirations');
    }
};



