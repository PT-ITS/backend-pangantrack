<?php

namespace App\Repositories;

use App\Models\Alat;

class AlatRepository
{
    public function listAlat()
    {
        try {
            $dataAlat = Alat::all();
            return [
                'id' => '1',
                'data' => $dataAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data alat'
            ];
        }
    }

    public function createAlat($request)
    {
        try {
            $dataAlat = Alat::create($request);
            return [
                'id' => '1',
                'data' => 'berhasil menambahkan data alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data alat'
            ];
        }
    }

    public function updateAlat($request)
    {
        try {
            $dataAlat = Alat::find($request['id']);
            $dataAlat->update($request);
            return [
                'id' => '1',
                'data' => 'berhasil mengubah data alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data alat'
            ];
        }
    }

    public function deleteAlat($id)
    {
        try {
            $dataAlat = Alat::find($id);
            $dataAlat->delete();
            return [
                'id' => '1',
                'data' => 'berhasil menghapus data alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data alat'
            ];
        }
    }
}