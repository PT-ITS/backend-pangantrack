<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bantuan extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_kab_kota",
        "jenis_bantuan",
        "jumlah_bantuan",
        "satuan_bantuan",
        "bulan",
        "tahun",
        // "keterangan",
        "user_id"
    ];

    public function kelompokTani()
    {
        return $this->belongsToMany(KelompokTani::class, 'bantuan_kelompok_tanis');
    }
}
