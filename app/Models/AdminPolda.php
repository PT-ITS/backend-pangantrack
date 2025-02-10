<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminPolda extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_admin',
        'nrp_admin',
        'jabatan_admin',
        'tempat_dinas_admin',
        'alamat_admin',
        'hp_admin',
        'user_id',
    ];
}
