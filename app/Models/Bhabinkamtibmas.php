<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bhabinkamtibmas extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bhabin',
        'nrp_bhabin',
        'jabatan_bhabin',
        'tempat_dinas_bhabin',
        'id_kab_kota',
        'kecamatan',
        'alamat_bhabin',
        'hp_bhabin',
        'user_id',
    ];
}
