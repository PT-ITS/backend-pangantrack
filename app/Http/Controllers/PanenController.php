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
                'data' => 'terjadi kesalahan dalam mengambil data panen',
            ]);
        }
    }

    public function createPanen(Request $request)
    {
        try {
            $validateData = $request->validate([
                'jumlah_panen' => 'required',
                'tanggal_panen' => 'required',
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
                'data' => 'terjadi kesalahan dalam menambahkan data panen',
            ]);
        }
    }

    public function updatePanen(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'jumlah_panen' => 'required',
                'tanggal_panen' => 'required',
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
                'data' => 'terjadi kesalahan dalam memperbarui data panen',
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
                'data' => 'terjadi kesalahan dalam menghapus data panen',
            ]);
        }
    }
}
