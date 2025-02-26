<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BantuanService;
use Illuminate\Support\Facades\Validator;

class BantuanController extends Controller
{
    private $bantuanService;

    public function __construct(BantuanService $bantuanService)
    {
        $this->bantuanService = $bantuanService;
    }

    public function detailBantuan($id)
    {
        try {
            $result = $this->bantuanService->detailBantuan($id);
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

    public function listBantuan()
    {
        try {
            $result = $this->bantuanService->listBantuan();
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

    public function createBantuan(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id_kab_kota' => 'required',
                'jenis_bantuan' => 'required',
                'jumlah_bantuan' => 'required',
                'satuan_bantuan' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
                // 'keterangan' => 'required',
                'kelompok_tani_id' => 'required|array',
                'kelompok_tani_id.*' => 'exists:kelompok_tanis,id',
            ]);
            $validateData['user_id'] = auth()->user()->id;

            $result = $this->bantuanService->createBantuan($validateData);
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

    public function updateBantuan(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'id_kab_kota' => 'required',
                'jenis_bantuan' => 'required',
                'jumlah_bantuan' => 'required',
                'satuan_bantuan' => 'required',
                'bulan' => 'required',
                'tahun' => 'required',
                // 'keterangan' => 'required',
                'kelompok_tani_id' => 'required|array',
                'kelompok_tani_id.*' => 'exists:kelompok_tanis,id',
            ]);
            $validateData['user_id'] = auth()->user()->id;

            $result = $this->bantuanService->updateBantuan($validateData, $id);
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

    public function deleteBantuan($id)
    {
        try {
            $result = $this->bantuanService->deleteBantuan($id);
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
