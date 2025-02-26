<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BantuanKelompokTani extends Model
{
    use HasFactory;

    protected $fillable = [
        "bantuan_id",
        "kelompok_tani_id",
    ];

    public function bantuan()
    {
        return $this->belongsToMany(Bantuan::class, 'bantuan_kelompok_tanis');
    }
}
