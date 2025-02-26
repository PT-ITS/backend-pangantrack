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
                'data' => $th->getMessage(),
            ]);
        }
    }

    public function listAlatByPenyedia($id)
    {
        try {
            $result = $this->alatService->listAlatByPenyedia($id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => $th->getMessage(),
            ]);
        }
    }

    public function createAlat(Request $request)
    {
        try {
            $validateData = $request->validate([
                'jenis_alat' => 'required',
                'nama_alat' => 'required',
                'deskripsi_alat' => 'required',
                // 'harga_sewa_alat' => 'required',
                'jumlah_alat' => 'required',
                'foto_alat' => 'required',
                // 'status' => 'required',
                'pemilik_id' => 'required',
            ]);
            $validateData['penyedia_id'] = auth()->user()->id;
            $result = $this->alatService->createAlat($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => $th->getMessage(),
            ]);
        }
    }

    public function updateAlat(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'jenis_alat' => 'required',
                'nama_alat' => 'required',
                'deskripsi_alat' => 'required',
                // 'harga_sewa_alat' => 'required',
                'jumlah_alat' => 'required',
                'foto_alat' => 'nullable',
                'status' => 'required',
                'pemilik_id' => 'required',
            ]);
            $validateData['penyedia_id'] = auth()->user()->id;
            $result = $this->alatService->updateAlat($validateData, $id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => $th->getMessage(),
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
                'data' => $th->getMessage(),
            ]);
        }
    }
}
