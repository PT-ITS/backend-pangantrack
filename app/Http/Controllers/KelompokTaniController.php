<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\KelompokTaniService;

class KelompokTaniController extends Controller
{
    private $kelompokTaniService;

    public function __construct(KelompokTaniService $kelompokTaniService)
    {
        $this->kelompokTaniService = $kelompokTaniService;
    }

    public function detailKelompokTani($id)
    {
        try {
            $result = $this->kelompokTaniService->detailKelompokTani($id);
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

    public function listKelompokTani()
    {
        try {
            $result = $this->kelompokTaniService->listKelompokTani();
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

    public function listKelompokTaniByBhabinkamtibmas($id)
    {
        try {
            $result = $this->kelompokTaniService->listKelompokTaniByBhabinkamtibmas($id);
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

    public function createKelompokTani(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nama_kelompok' => 'required',
                'status_kelompok' => 'required',
                'alamat_kelompok' => 'required',
                'ketua_kelompok' => 'required',
                'alamat_ketua' => 'required',
                'hp_ketua' => 'required',
                'foto_kelompok' => 'required',
                'id_kab_kota' => 'required',
                'user_id' => 'required',
            ]);

            $result = $this->kelompokTaniService->createKelompokTani($validateData);
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

    public function updateKelompokTani(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'nama_kelompok' => 'required',
                'status_kelompok' => 'required',
                'alamat_kelompok' => 'required',
                'ketua_kelompok' => 'required',
                'alamat_ketua' => 'required',
                'hp_ketua' => 'required',
                'foto_kelompok' => 'nullable',
                'user_id' => 'required',
            ]);

            $result = $this->kelompokTaniService->updateKelompokTani($validateData, $id);
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

    public function deleteKelompokTani($id)
    {
        try {
            $result = $this->kelompokTaniService->deleteKelompokTani($id);
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
