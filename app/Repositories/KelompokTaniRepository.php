<?php

namespace App\Repositories;

use App\Models\KelompokTani;

class KelompokTaniRepository
{
    public function find($id)
    {
        return KelompokTani::find($id);
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

}