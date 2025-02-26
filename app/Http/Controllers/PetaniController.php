<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PetaniService;

class PetaniController extends Controller
{
    private $petaniService;

    public function __construct(PetaniService $petaniService)
    {
        $this->petaniService = $petaniService;
    }

    public function listPetaniByKelompok($id)
    {
        try {
            $result = $this->petaniService->listPetaniByKelompok($id);
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

    public function createPetani(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nama_petani' => 'required',
                'alamat_petani' => 'required',
                'hp_petani' => 'required',
                'kelompok_id' => 'required',
            ]);
            $result = $this->petaniService->createPetani($validateData);
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

    public function updatePetani(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'nama_petani' => 'required',
                'alamat_petani' => 'required',
                'hp_petani' => 'required',
                'kelompok_id' => 'required',
            ]);
            $result = $this->petaniService->updatePetani($validateData, $id);
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

    public function deletePetani($id)
    {
        try {
            $result = $this->petaniService->deletePetani($id);
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
