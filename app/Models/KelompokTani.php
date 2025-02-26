<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelompokTani extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_kelompok',
        'status_kelompok',
        'alamat_kelompok',
        'ketua_kelompok',
        'alamat_ketua',
        'hp_ketua',
        'foto_kelompok',
        'jumlah_anggota',
        'id_kab_kota',
        'kecamatan',
        'desa',
        'luas_lahan',
        'koodinator',
        'user_id',
    ];
}
