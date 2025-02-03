<?php

namespace App\Repositories;

use App\Models\JenisPanen;
use App\Models\KelompokTani;
use App\Models\Panen;
use App\Models\Petani;

class KelompokTaniRepository
{
    public function find($id)
    {
        return KelompokTani::find($id);
    }

    public function detailKelompokTani($id)
    {
        try {
            // Fetch KelompokTani details
            $dataKelompokTani = KelompokTani::find($id);

            if (!$dataKelompokTani) {
                return [
                    'id' => '0',
                    'data' => 'Kelompok Tani tidak ditemukan'
                ];
            }

            // Get all petani IDs under the given kelompok_id
            $idPetani = Petani::where('kelompok_id', $id)->pluck('id')->toArray();

            // Count jumlah_petani
            $jumlahPetani = count($idPetani);

            // Count jumlah_jenis_panen (unique count of jenis_panen_id in Panen)
            $jumlahJenisPanen = Panen::whereIn('petani_id', $idPetani)->distinct('jenis_panen_id')->count('jenis_panen_id');

            // Get daftar_jenis_panen based on jenis_panen_id from Panen
            $daftarJenisPanen = JenisPanen::whereIn(
                'id',
                Panen::whereIn('petani_id', $idPetani)->pluck('jenis_panen_id')
            )
                ->withSum(['panens' => function ($query) use ($idPetani) {
                    $query->whereIn('petani_id', $idPetani);
                }], 'jumlah_panen')
                ->get();

            // Sum jumlah_panen from Panen
            $jumlahPanen = Panen::whereIn('petani_id', $idPetani)->sum('jumlah_panen');

            // Sum total_luas_lahan from Petani
            $totalLuasLahan = Petani::where('kelompok_id', $id)->sum('luas_lahan');

            return [
                'id' => '1',
                'data' => [
                    "kelompok_tani" => $dataKelompokTani,
                    "jumlah_petani" => $jumlahPetani,
                    "jumlah_jenis_panen" => $jumlahJenisPanen,
                    "daftar_jenis_panen" => $daftarJenisPanen,
                    "jumlah_panen" => $jumlahPanen,
                    "total_luas_lahan" => $totalLuasLahan,
                ],
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage(),
            ];
        }
    }

    public function listKelompokTani()
    {
        try {
            $dataKelompokTani = KelompokTani::all();
            return [
                'id' => '1',
                'data' => $dataKelompokTani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengambil data kelompok tani'
            ];
        }
    }

    public function listKelompokTaniByBhabinkamtibmas($id)
    {
        try {
            $dataKelompokTani = KelompokTani::where('user_id', $id)->get();
            return [
                'id' => '1',
                'data' => $dataKelompokTani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengambil data kelompok tani'
            ];
        }
    }

    public function createKelompokTani($dataRequest)
    {
        try {
            $dataKelompokTani = KelompokTani::create($dataRequest);
            return [
                'id' => '1',
                'data' => 'berhasil menambahkan data kelompok tani'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal menambahkan data kelompok tani'
            ];
        }
    }

    public function updateKelompokTani($dataRequest, $id)
    {
        try {
            $dataKelompokTani = KelompokTani::find($id);
            $dataKelompokTani->update($dataRequest);
            return [
                'id' => '1',
                'data' => 'berhasil mengubah data kelompok tani'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengubah data kelompok tani'
            ];
        }
    }

    public function deleteKelompokTani($id)
    {
        try {
            $dataKelompokTani = KelompokTani::find($id);
            $dataKelompokTani->delete();
            return [
                'id' => '1',
                'data' => 'berhasil menghapus data kelompok tani'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data kelompok tani'
            ];
        }
    }
}
