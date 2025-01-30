<?php

namespace App\Repositories;

use App\Models\JenisPanen;

class JenisPanenRepository
{
    private $jenisPanenModel;

    public function __construct(JenisPanen $jenisPanenModel)
    {
        $this->jenisPanenModel = $jenisPanenModel;
    }

    public function listJenisPanen()
    {
        try {
            $data = $this->jenisPanenModel->all();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data jenis panen'
            ];
        }
    }

    public function find($id)
    {
        return $this->jenisPanenModel->find($id);
    }

    public function createJenisPanen($data)
    {
        try {
            $dataJenisPanen = $this->jenisPanenModel->create($data);
            return [
                'id' => '1',
                'data' => 'berhasil menambahkan data jenis panen'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data jenis panen'
            ];
        }
    }

    public function updateJenisPanen($data, $id)
    {
        try {
            $dataJenisPanen = $this->jenisPanenModel->find($id)->update($data);
            return [
                'id' => '1',
                'data' => 'berhasil mengubah data jenis panen'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data jenis panen'
            ];
        }
    }

    public function deleteJenisPanen($id)
    {
        try {
            $dataJenisPanen = $this->jenisPanenModel->find($id)->delete();
            return [
                'id' => '1',
                'data' => 'berhasil menghapus data jenis panen'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data jenis panen'
            ];
        }
    }
}
