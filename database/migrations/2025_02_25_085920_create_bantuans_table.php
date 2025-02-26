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
        Schema::create('bantuans', function (Blueprint $table) {
            $table->id();
            $table->string('id_kab_kota');
            $table->string('jenis_bantuan');
            $table->string('jumlah_bantuan');
            $table->string('satuan_bantuan');
            $table->string('tahun');
            $table->string('keterangan');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade'); // id admin yg memberikan bantuan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bantuans');
    }
};
