<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenyediaService;

class PenyediaController extends Controller
{
    private $penyediaService;

    public function __construct(PenyediaService $penyediaService)
    {
        $this->penyediaService = $penyediaService;
    }

    public function listPenyedia()
    {
        try {
            $result = $this->penyediaService->listPenyedia();
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data penyedia',
            ]);
        }
    }

    public function createPenyedia(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'wilayah' => 'required',
                'id_pj' => 'required',
            ]);
            $result = $this->penyediaService->createPenyedia($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data penyedia',
            ]);
        }
    }

    public function updatePenyedia(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id' => 'required',
                'name' => 'required',
                'wilayah' => 'required',
                'id_pj' => 'required',
            ]);
            $result = $this->penyediaService->updatePenyedia($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengupdate data penyedia',
            ]);
        }
    }

    public function deletePenyedia($id)
    {
        try {
            $result = $this->penyediaService->deletePenyedia($id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data penyedia',
            ]);
        }
    }   
}
