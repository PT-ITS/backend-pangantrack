<?php

namespace App\Repositories;

use App\Models\Penyedia;

class PenyediaRepository
{
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

    public function createPenyedia($data)
    {
        try {
            $dataPenyedia = Penyedia::create($data);
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

    public function updatePenyedia($id, $data)
    {
        try {
            $dataPenyedia = Penyedia::where('id', $id)->update($data);
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
            $dataPenyedia = Penyedia::where('id', $id)->delete();
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

    public function find($id)
    {
        return Penyedia::find($id);
    }
}