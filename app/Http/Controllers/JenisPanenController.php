<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\JenisPanenService;

class JenisPanenController extends Controller
{
    private $jenisPanenService;

    public function __construct(JenisPanenService $jenisPanenService)
    {
        $this->jenisPanenService = $jenisPanenService;
    }

    public function listJenisPanen()
    {
        try {
            $result = $this->jenisPanenService->listJenisPanen();
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

    public function createJenisPanen(Request $request)
    {
        try {
            $validateData = $request->validate([
                'jenis_panen' => 'required',
                'foto_jenis' => 'required',
            ]);
            $result = $this->jenisPanenService->createJenisPanen($validateData);
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

    public function updateJenisPanen(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'jenis_panen' => 'required',
                'foto_jenis' => 'nullable',
            ]);
            $result = $this->jenisPanenService->updateJenisPanen($validateData, $id);
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

    public function deleteJenisPanen($id)
    {
        try {
            $result = $this->jenisPanenService->deleteJenisPanen($id);
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
