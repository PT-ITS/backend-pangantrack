<?php

namespace App\Repositories;

use App\Models\SewaAlat;

class SewaAlatRepository
{
    public function listSewaAlatByKelompokTani($id)
    {
        try {
            $dataSewaAlat = SewaAlat::join('kelompok_tanis', 'sewa_alats.id_kelompok', '=', 'kelompok_tanis.id')
                ->join('alats', 'sewa_alats.id_alat', '=', 'alats.id')
                ->select('sewa_alats.*', 'alats.nama_alat', 'alats.foto_alat', 'kelompok_tanis.nama_kelompok')
                ->where('id_kelompok', $id)
                ->get();
            return [
                'id' => '1',
                'data' => $dataSewaAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat'
            ];
        }
    }

    public function listSewaAlatByBhabinkamtibmas($id)
    {
        try {
            $dataSewaAlat = SewaAlat::join('kelompok_tanis', 'sewa_alats.id_kelompok', '=', 'kelompok_tanis.id')
                ->join('alats', 'sewa_alats.id_alat', '=', 'alats.id')
                ->select('sewa_alats.*', 'alats.nama_alat', 'alats.foto_alat', 'kelompok_tanis.nama_kelompok')
                ->where('id_babinsa', $id)
                ->get();
            return [
                'id' => '1',
                'data' => $dataSewaAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat'
            ];
        }
    }

    public function listSewaAlatByPenyedia($id)
    {
        try {
            $dataSewaAlat = SewaAlat::join('kelompok_tanis', 'sewa_alats.id_kelompok', '=', 'kelompok_tanis.id')
                ->join('alats', 'sewa_alats.id_alat', '=', 'alats.id')
                ->select('sewa_alats.*', 'alats.nama_alat', 'alats.foto_alat', 'kelompok_tanis.nama_kelompok')
                ->where('penyedia_id', $id)
                ->get();
            return [
                'id' => '1',
                'data' => $dataSewaAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat'
            ];
        }
    }

    public function pengajuanSewaAlat($data)
    {
        try {
            $dataSewaAlat = SewaAlat::create($data);
            return [
                'id' => '1',
                'data' => 'berhasil menambahkan data sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data sewa alat'
            ];
        }
    }

    public function pengajuanPengembalianSewaAlat($id)
    {
        try {
            $dataSewaAlat = SewaAlat::find($id);
            $dataSewaAlat->update(['status' => '3']);
            return [
                'id' => '1',
                'data' => 'berhasil mengajukan pengembalian sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengajukan pengembalian sewa alat'
            ];
        }
    }

    public function aksiPengajuanSewaAlat($data, $id)
    {
        try {
            $dataSewaAlat = SewaAlat::find($id);
            $dataSewaAlat->update(['status' => $data['status']]);
            return [
                'id' => '1',
                'data' => 'berhasil memvalidasi pengajuan sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam memvalidasi pengajuan sewa alat'
            ];
        }
    }

    public function updateSewaAlat($data)
    {
        try {
            $dataSewaAlat = SewaAlat::find($data['id']);
            $dataSewaAlat->update($data);
            return [
                'id' => '1',
                'data' => 'berhasil mengubah data sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data sewa alat'
            ];
        }
    }

    public function deleteSewaAlat($id)
    {
        try {
            $dataSewaAlat = SewaAlat::find($id);
            $dataSewaAlat->delete();
            return [
                'id' => '1',
                'data' => 'berhasil menghapus data sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data sewa alat'
            ];
        }
    }

    public function find($id)
    {
        return SewaAlat::find($id);
    }
}
