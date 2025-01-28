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
                'data' => $th->getMessage(),
            ]);
        }
    }

    public function createPenyedia(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nama' => 'required',
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
                'data' => $th->getMessage(),
            ]);
        }
    }

    public function updatePenyedia(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'nama' => 'required',
                'wilayah' => 'required',
                'id_pj' => 'required',
            ]);
            $result = $this->penyediaService->updatePenyedia($validateData, $id);
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
                'data' => $th->getMessage(),
            ]);
        }
    }
}
