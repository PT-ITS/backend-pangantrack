<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PanenService;

class PanenController extends Controller
{
    private $panenService;

    public function __construct(PanenService $panenService)
    {
        $this->panenService = $panenService;
    }

    public function listPanenByPetani($id)
    {
        try {
            $result = $this->panenService->listPanenByPetani($id);
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

    public function createPanen(Request $request)
    {
        try {
            $validateData = $request->validate([
                'jumlah_panen' => 'nullable',
                'tanggal_tanam' => 'nullable',
                'tanggal_panen' => 'nullable',
                'status_panen' => 'required',
                'petani_id' => 'required',
                'jenis_panen_id' => 'required'
            ]);
            $result = $this->panenService->createPanen($validateData);
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

    public function updatePanen(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'jumlah_panen' => 'nullable',
                'tanggal_tanam' => 'nullable',
                'tanggal_panen' => 'nullable',
                'status_panen' => 'required',
                'petani_id' => 'required',
                'jenis_panen_id' => 'required'
            ]);
            $result = $this->panenService->updatePanen($validateData, $id);
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

    public function deletePanen($id)
    {
        try {
            $result = $this->panenService->deletePanen($id);
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
