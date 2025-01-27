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
                'data' => 'terjadi kesalahan dalam mengambil data kelompok tani',
            ]);
        }
    }

    public function createKelompokTani(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name_kelompok' => 'required',
                'status_kelompok' => 'required',
                'alamat_kelompok' => 'required',
                'ketua_kelompok' => 'required',
                'alamat_ketua' => 'required',
                'hp_ketua' => 'required',
                'foto_kelompok' => 'required',
                'user_id' => 'required',
            ]);

            $result = $this->kelompokTaniService->createKelompokTani($request);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data kelompok tani',
            ]);
        }
    }

    public function updateKelompokTani(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'name_kelompok' => 'required',
                'status_kelompok' => 'required',
                'alamat_kelompok' => 'required',
                'ketua_kelompok' => 'required',
                'alamat_ketua' => 'required',
                'hp_ketua' => 'required',
                'foto_kelompok' => 'required',
                'user_id' => 'required',
            ]);

            $result = $this->kelompokTaniService->updateKelompokTani($request, $id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data kelompok tani',
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
                'data' => 'terjadi kesalahan dalam menghapus data kelompok tani',
            ]);
        }
    }
}
