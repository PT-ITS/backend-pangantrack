<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisPanen extends Model
{
    use HasFactory;

    protected $fillable = [
        'jenis_panen',
        'foto_jenis'
    ];
}
