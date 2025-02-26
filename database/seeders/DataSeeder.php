<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Bantuan;
use App\Models\BantuanKelompokTani;
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
            'nama_kelompok' => 'Kelompok Tani Mutiara Agung',
            'status_kelompok' => '1',
            'alamat_kelompok' => 'Jl. Kurma',
            'ketua_kelompok' => 'Zamorano',
            'alamat_ketua' => 'Jl. Kurma',
            'hp_ketua' => '08123456789',
            'foto_kelompok' => 'kelompok_tani/default.jpg',
            'jumlah_anggota' => '10',
            'id_kab_kota' => '3601',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'luas_lahan' => '10',
            'koordinat' => '-6.1171233, 106.1538912',
            'user_id' => '4'
        ]);
        KelompokTani::create([
            'nama_kelompok' => 'Kelompok Tani Sukses Bersama',
            'status_kelompok' => '1',
            'alamat_kelompok' => 'Jl. Kurma',
            'ketua_kelompok' => 'Jhezy',
            'alamat_ketua' => 'Jl. Kurma',
            'hp_ketua' => '08123456789',
            'foto_kelompok' => 'kelompok_tani/default.jpg',
            'jumlah_anggota' => '10',
            'id_kab_kota' => '3602',
            'kecamatan' => 'Kecamatan',
            'desa' => 'Desa',
            'luas_lahan' => '10',
            'koordinat' => '-6.1171233, 106.1538912',
            'user_id' => '4'
        ]);
        // Petani
        Petani::create([
            'nama_petani' => 'Zamorano',
            'alamat_petani' => 'Jl. Kurma',
            'hp_petani' => '08123456789',
            'kelompok_id' => '1',
        ]);
        Petani::create([
            'nama_petani' => 'Jhezy',
            'alamat_petani' => 'Jl. Kurma',
            'hp_petani' => '08123456789',
            'kelompok_id' => '2',
        ]);
        // Jenis Panen
        $jenisPanenList = [
            'Padi',
            'Jagung',
            'Kedelai',
            'Kacang Tanah',
            'Singkong',
            'Ubi Jalar',
            'Tebu',
            'Kelapa Sawit',
            'Kopi',
            'Kakao',
            'Teh',
            'Cengkeh',
            'Vanili',
            'Lada',
            'Cabai',
            'Tomat',
            'Bawang Merah',
            'Bawang Putih',
            'Wortel',
            'Kubis',
            'Timun',
            'Terong',
            'Semangka',
            'Melon',
            'Durian',
            'Mangga',
            'Nanas',
            'Pisang',
            'Rambutan',
            'Salak'
        ];

        foreach ($jenisPanenList as $jenis) {
            JenisPanen::create([
                'jenis_panen' => $jenis,
                'foto_jenis' => 'jenis_panen/default.jpeg',
            ]);
        }
        // Panen
        Panen::create([
            'jumlah_panen' => '10',
            'tanggal_tanam' => '2024-08-02',
            'tanggal_panen' => '2025-02-02',
            'status_panen' => '2',
            'kelompok_tani_id' => '1',
            'jenis_panen_id' => '1',
        ]);
        Panen::create([
            'tanggal_tanam' => '2025-02-02',
            'status_panen' => '1',
            'kelompok_tani_id' => '2',
            'jenis_panen_id' => '1',
        ]);
        // Alsintan
        Alat::create([
            'jenis_alat' => 'Traktor',
            'nama_alat' => 'Traktor Kubota',
            'deskripsi_alat' => 'Untuk membajak sawah',
            // 'harga_sewa_alat' => '500000',
            'jumlah_alat' => '1',
            'foto_alat' => 'alat_tani/default.jpeg',
            'status' => '1',
            'pemilik_id' => '1',
            'penyedia_id' => '3',
        ]);
        Alat::create([
            'jenis_alat' => 'Mower',
            'nama_alat' => 'LCPOWER Komodo Lawn Mower 2.0',
            'deskripsi_alat' => 'Untuk memotong rumput',
            // 'harga_sewa_alat' => '300000',
            'jumlah_alat' => '3',
            'foto_alat' => 'alat_tani/default.jpeg',
            'status' => '1',
            'pemilik_id' => '2',
            'penyedia_id' => '3',
        ]);
        // Bantuan
        Bantuan::create([
            'id_kab_kota' => '3601',
            'jenis_bantuan' => 'Bibit Jagung',
            'jumlah_bantuan' => '4',
            'satuan_bantuan' => 'ton',
            'tahun' => '2025',
            'keterangan' => 'Bantuan dari Dinas Pertanian dan Ketahanan Pangan',
            'user_id' => '1'
        ]);
        BantuanKelompokTani::create([
            'bantuan_id' => '1',
            'kelompok_tani_id' => '1'
        ]);
    }
}
