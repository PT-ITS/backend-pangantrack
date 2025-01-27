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
                'data' => 'terjadi kesalahan dalam mengambil data jenis panen',
            ]);
        }
    }

    public function createJenisPanen(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name_jenis_panen' => 'required',
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
                'data' => 'terjadi kesalahan dalam menambahkan data jenis panen',
            ]);
        }
    }

    public function updateJenisPanen(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id_jenis_panen' => 'required',
                'name_jenis_panen' => 'required',
                'foto_jenis' => 'required',
            ]);
            $result = $this->jenisPanenService->updateJenisPanen($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data jenis panen',
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
                'data' => 'terjadi kesalahan dalam menghapus data jenis panen',
            ]);
        }
    }
}
