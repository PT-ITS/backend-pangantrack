<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BhabinkamtibmasService;
use Illuminate\Support\Facades\Validator;

class BhabinkamtibmasController extends Controller
{
    private $bhabinkamtibmasService;

    public function __construct(BhabinkamtibmasService $bhabinkamtibmasService)
    {
        $this->bhabinkamtibmasService = $bhabinkamtibmasService;
    }

    public function detailBhabinkamtibmas($id)
    {
        try {
            $result = $this->bhabinkamtibmasService->detailBhabinkamtibmas($id);
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

    public function detailBhabinkamtibmasByUserId($id)
    {
        try {
            $result = $this->bhabinkamtibmasService->detailBhabinkamtibmasByUserId($id);
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

    public function listBhabinkamtibmas()
    {
        try {
            $result = $this->bhabinkamtibmasService->listBhabinkamtibmas();
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

    public function createBhabinkamtibmas(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'nama_bhabin' => 'required',
                'nrp_bhabin' => 'required',
                'jabatan_bhabin' => 'required',
                'tempat_dinas_bhabin' => 'required',
                'id_kab_kota' => 'required',
                'kecamatan' => 'required',
                'alamat_bhabin' => 'required',
                'hp_bhabin' => 'required',
            ]);
            $result = $this->bhabinkamtibmasService->createBhabinkamtibmas($validateData);
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

    public function updateBhabinkamtibmas(Request $request, $id)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required',
                'nama_bhabin' => 'required',
                'nrp_bhabin' => 'required',
                'jabatan_bhabin' => 'required',
                'tempat_dinas_bhabin' => 'required',
                'id_kab_kota' => 'required',
                'kecamatan' => 'required',
                'alamat_bhabin' => 'required',
                'hp_bhabin' => 'required',
            ]);
            $result = $this->bhabinkamtibmasService->updateBhabinkamtibmas($request, $id);
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

    public function deleteBhabinkamtibmas($id)
    {
        try {
            $result = $this->bhabinkamtibmasService->deleteBhabinkamtibmas($id);
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
