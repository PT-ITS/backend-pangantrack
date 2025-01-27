<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AlatService;

class AlatController extends Controller
{
    private $alatService;

    public function __construct(AlatService $alatService)
    {
        $this->alatService = $alatService;
    }

    public function listAlat()
    {
        try {
            $result = $this->alatService->listAlat();
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data alat',
            ]);
        }
    }

    public function createAlat(Request $request)
    {
        try {
            $validateData = $request->validate([
                'jenis_alat' => 'required',
                'name_alat' => 'required',
                'deskripsi_alat' => 'required',
                'foto_alat' => 'required',
                'status' => 'required',
                'penyedia_id' => 'required',
            ]);
            $result = $this->alatService->createAlat($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data alat',
            ]);
        }
    }

    public function updateAlat(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id' => 'required',
                'jenis_alat' => 'required',
                'name_alat' => 'required',
                'deskripsi_alat' => 'required',
                'foto_alat' => 'required',
                'status' => 'required',
                'penyedia_id' => 'required',
            ]);
            $result = $this->alatService->updateAlat($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data alat',
            ]);
        }
    }

    public function deleteAlat($id)
    {
        try {
            $result = $this->alatService->deleteAlat($id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data alat',
            ]);
        }
    }
}
