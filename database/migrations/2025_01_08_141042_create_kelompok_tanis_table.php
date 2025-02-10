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
        Schema::create('kelompok_tanis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelompok');
            $table->enum('status_kelompok', [
                '0', // tidak aktif
                '1' // aktif
            ]);
            $table->text('alamat_kelompok');
            $table->string('ketua_kelompok');
            $table->string('alamat_ketua');
            $table->string('hp_ketua');
            $table->string('foto_kelompok');
            $table->string('id_kab_kota');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // id bhabin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelompok_tanis');
    }
};
