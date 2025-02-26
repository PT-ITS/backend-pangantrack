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
        Schema::create('bantuan_kelompok_tanis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bantuan_id')->constrained('bantuans')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kelompok_tani_id')->constrained('kelompok_tanis')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuan_kelompok_tanis');
    }
};
