<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\JenisPanen;
use App\Models\KelompokTani;
use App\Models\Panen;
use App\Models\Penyedia;
use App\Models\Petani;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kelompok Tani
        KelompokTani::create([
            'nama_kelompok' => 'Petani Racing',
            'status_kelompok' => '1',
            'alamat_kelompok' => 'Jl. Kurma',
            'ketua_kelompok' => 'Zamorano',
            'alamat_ketua' => 'Jl. Kurma',
            'hp_ketua' => '08123456789',
            'foto_kelompok' => 'kelompok_tani/default.jpg',
            'user_id' => '2'
        ]);
        KelompokTani::create([
            'nama_kelompok' => 'Petani Gacor',
            'status_kelompok' => '1',
            'alamat_kelompok' => 'Jl. Kurma',
            'ketua_kelompok' => 'Jhezy',
            'alamat_ketua' => 'Jl. Kurma',
            'hp_ketua' => '08123456789',
            'foto_kelompok' => 'kelompok_tani/default.jpg',
            'user_id' => '2'
        ]);
        // Petani
        Petani::create([
            'nama_petani' => 'Zamorano',
            'alamat_petani' => 'Jl. Kurma',
            'hp_petani' => '08123456789',
            'luas_lahan' => '10',
            'koordinat_lahan' => '-7.0013231,113.8631895',
            'kelompok_id' => '1',
        ]);
        Petani::create([
            'nama_petani' => 'Jhezy',
            'alamat_petani' => 'Jl. Kurma',
            'hp_petani' => '08123456789',
            'luas_lahan' => '10',
            'koordinat_lahan' => '-7.0013231,113.8631895',
            'kelompok_id' => '2',
        ]);
        // Jenis Panen
        JenisPanen::create([
            'jenis_panen' => 'Padi',
            'foto_jenis' => 'jenis_panen/default.jpeg',
        ]);
        // Panen
        Panen::create([
            'jumlah_panen' => '10',
            'tanggal_tanam' => '2024-08-02',
            'tanggal_panen' => '2025-02-02',
            'status_panen' => '2',
            'petani_id' => '1',
            'jenis_panen_id' => '1',
        ]);
        Panen::create([
            'tanggal_tanam' => '2025-02-02',
            'status_panen' => '1',
            'petani_id' => '2',
            'jenis_panen_id' => '1',
        ]);
        // Penyedia
        Penyedia::create([
            'nama' => 'Fadel',
            'wilayah' => 'Jl. Kurma',
            'id_pj' => '2',
        ]);
        Penyedia::create([
            'nama' => 'Kevin',
            'wilayah' => 'Jl. Kurma',
            'id_pj' => '2',
        ]);
        // Alsintan
        Alat::create([
            'jenis_alat' => 'Traktor',
            'nama_alat' => 'Traktor Kubota',
            'deskripsi_alat' => 'Untuk membajak sawah',
            'harga_sewa_alat' => '500000',
            'jumlah_alat' => '1',
            'foto_alat' => 'alat_tani/default.jpeg',
            'status' => '1',
            'penyedia_id' => '1',
        ]);
        Alat::create([
            'jenis_alat' => 'Mower',
            'nama_alat' => 'LCPOWER Komodo Lawn Mower 2.0',
            'deskripsi_alat' => 'Untuk memotong rumput',
            'harga_sewa_alat' => '300000',
            'jumlah_alat' => '3',
            'foto_alat' => 'alat_tani/default.jpeg',
            'status' => '1',
            'penyedia_id' => '2',
        ]);
    }
}
