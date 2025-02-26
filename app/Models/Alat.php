<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_alat',
        'nama_alat',
        'deskripsi_alat',
        // 'harga_sewa_alat',
        'jumlah_alat',
        'foto_alat',
        'status',
        'pemilik_id',
        'penyedia_id',
    ];
}
