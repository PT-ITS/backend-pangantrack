<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_alat',
        'name_alat',
        'deskripsi_alat',
        'foto_alat',
        'status',
        'penyedia_id',
    ];
}
