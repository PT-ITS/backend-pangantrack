<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panen extends Model
{
    use HasFactory;

    protected $fillable = [
        'jumlah_panen',
        'tanggal_tanam',
        'tanggal_panen',
        'status_panen',
        'kelompok_tani_id',
        'jenis_panen_id',
    ];
}
