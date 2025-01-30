<?php

namespace App\Repositories;

use App\Models\Penyedia;

class PenyediaRepository
{
    public function find($id)
    {
        return Penyedia::find($id);
    }

    public function listPenyedia()
    {
        try {
            $dataPenyedia = Penyedia::all();
            return [
                'id' => '1',
                'data' => $dataPenyedia
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data penyedia'
            ];
        }
    }

    public function createPenyedia($requestData)
    {
        try {
            $dataPenyedia = Penyedia::create($requestData);
            return [
                'id' => '1',
                'data' => $dataPenyedia
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data penyedia'
            ];
        }
    }

    public function updatePenyedia($requestData, $id)
    {
        try {
            $dataPenyedia = Penyedia::find($id)->update($requestData);
            return [
                'id' => '1',
                'data' => $dataPenyedia
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam memperbarui data penyedia'
            ];
        }
    }

    public function deletePenyedia($id)
    {
        try {
            $dataPenyedia = Penyedia::find($id)->delete();
            return [
                'id' => '1',
                'data' => $dataPenyedia
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data penyedia'
            ];
        }
    }
}
