<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aspiration_feedback', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aspiration_id')->constrained('aspirations')->cascadeOnDelete();
            $table->foreignId('admin_id')->constrained('users')->restrictOnDelete();

            $table->text('message');
            $table->string('status_after', 20);
            $table->unsignedTinyInteger('progress_percent_after')->default(0);

            $table->timestamps();

            $table->index(['aspiration_id', 'created_at']);
            $table->index(['admin_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspiration_feedback');
    }
};



