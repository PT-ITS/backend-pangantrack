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
        Schema::create('alats', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_alat');
            $table->string('nama_alat');
            $table->string('deskripsi_alat');
            $table->string('lokasi_awal_alat');
            // $table->string('harga_sewa_alat');
            $table->string('jumlah_alat');
            $table->string('foto_alat');
            $table->enum('status', [
                '0', // tidak tersedia
                '1', // tersedia
            ])->default('1');
            $table->foreignId('pemilik_id')->constrained('kelompok_tanis')->onDelete('cascade')->onUpdate('cascade'); // pemilik alsintan / kelompok tani
            $table->foreignId('penyedia_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // koordinator alsintan / admin / bhabin
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alats');
    }
};
