<?php

namespace App\Repositories;

use App\Models\SewaAlat;

class SewaAlatRepository
{
    public function listSewaAlatByKelompokTani()
    {
        try {
            $dataSewaAlat = SewaAlat::all();
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

    public function aksiPengajuanSewaAlat($data)
    {
        try {
            $dataSewaAlat = SewaAlat::find($data['id']);
            $dataSewaAlat->update(['status' => $data['status']]);
            return [
                'id' => '1',
                'data' => 'berhasil menyetujui pengajuan sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menyetujui pengajuan sewa alat'
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