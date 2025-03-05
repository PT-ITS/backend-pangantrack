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
        Schema::create('panens', function (Blueprint $table) {
            $table->id();
            $table->string('jumlah_panen')->nullable();
            $table->date('tanggal_tanam')->nullable();
            $table->date('tanggal_panen')->nullable();
            $table->enum('status_panen', [
                '0', // belum tanam
                '1', // tanam
                '2' //panen
            ]);
            $table->string('alasan')->nullable();
            $table->foreignId('kelompok_tani_id')->constrained('kelompok_tanis')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('jenis_panen_id')->constrained('jenis_panens')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panens');
    }
};
