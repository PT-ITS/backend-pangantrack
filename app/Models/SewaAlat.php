<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SewaAlat extends Model
{
    use HasFactory;

    protected $fillable = [
        'tanggal_sewa',
        'tanggal_kembali',
        'jumlah_alat_disewa',
        'status',
        'id_alat',
        'id_kelompok',
        'id_babinsa',
    ];
}
