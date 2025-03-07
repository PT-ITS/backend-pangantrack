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
        Schema::create('bhabinkamtibmas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bhabin');
            $table->string('nrp_bhabin');
            $table->string('jabatan_bhabin');
            $table->string('tempat_dinas_bhabin');
            $table->string('id_kab_kota');
            $table->string('kecamatan');
            $table->string('alamat_bhabin');
            $table->string('hp_bhabin');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bhabinkamtibmas');
    }
};
