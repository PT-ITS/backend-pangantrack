<?php

namespace App\Repositories;

use App\Models\Panen;

class PanenRepository
{
    private $panenModel;

    public function __construct(Panen $panenModel)
    {
        $this->panenModel = $panenModel;
    }

    public function listPanenByKelompokTani($id)
    {
        try {
            $data = $this->panenModel->where('kelompok_tani_id', $id)->with('jenisPanen')->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data panen'
            ];
        }
    }

    public function createPanen($data)
    {
        try {
            $panen = $this->panenModel->create($data);
            return [
                'id' => '1',
                'data' => $panen
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data panen'
            ];
        }
    }

    public function updatePanen($data, $id)
    {
        try {
            $panen = $this->panenModel->where('id', $id)->update($data);
            return [
                'id' => '1',
                'data' => $panen
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam memperbarui data panen'
            ];
        }
    }

    public function deletePanen($id)
    {
        try {
            $panen = $this->panenModel->where('id', $id)->delete();
            return [
                'id' => '1',
                'data' => $panen
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data panen'
            ];
        }
    }
}
