<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petani extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_petani',
        'alamat_petani',
        'hp_petani',
        'kelompok_id',
    ];
}
