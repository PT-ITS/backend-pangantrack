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
        Schema::create('sewa_alats', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_sewa');
            $table->date('tanggal_kembali');
            $table->string('jumlah_alat_disewa');
            $table->enum('status', [
                '0', // pengajuan
                '1', // pengajuan disetujui
                '2', // pengajuan ditolak
                '3', // pengembalian
                '4', // pengembalian disetujui
                '5', // pengembalian ditolak
            ])->default('0');
            $table->foreignId('id_alat')->constrained('alats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_kelompok')->constrained('kelompok_tanis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('id_babinsa')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sewa_alats');
    }
};
