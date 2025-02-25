<?php

namespace App\Repositories;

use App\Models\Petani;

class PetaniRepository
{
    private $petaniModel;
    public function __construct(Petani $petaniModel)
    {
        $this->petaniModel = $petaniModel;
    }

    public function listPetaniByKelompok($id)
    {
        try {
            $dataPetani = $this->petaniModel->where('kelompok_id', $id)->get();
            return [
                'id' => '1',
                'data' => $dataPetani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data petani'
            ];
        }
    }

    public function createPetani($data)
    {
        try {
            $dataPetani = Petani::create($data);
            return [
                'id' => '1',
                'data' => $dataPetani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data petani' . $th
            ];
        }
    }

    public function updatePetani($data, $id)
    {
        try {
            $dataPetani = Petani::find($id)->update($data);
            return [
                'id' => '1',
                'data' => $dataPetani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data petani'
            ];
        }
    }

    public function deletePetani($id)
    {
        try {
            $dataPetani = Petani::find($id)->delete();
            return [
                'id' => '1',
                'data' => $dataPetani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data petani'
            ];
        }
    }
}
