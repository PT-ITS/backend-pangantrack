<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyedia extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'alamat',
        'hp',
        'wilayah',
        'id_pj',
    ];
}
