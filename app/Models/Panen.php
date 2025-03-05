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
        'alasan',
        'kelompok_tani_id',
        'jenis_panen_id',
    ];

    public function jenisPanen()
    {
        return $this->belongsTo(JenisPanen::class, 'jenis_panen_id');
    }

    public function kelompokTani()
    {
        return $this->belongsTo(KelompokTani::class, 'kelompok_tani_id');
    }
}
