<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PenyediaService;
use Illuminate\Support\Facades\Validator;

class PenyediaController extends Controller
{
    private $penyediaService;

    public function __construct(PenyediaService $penyediaService)
    {
        $this->penyediaService = $penyediaService;
    }

    public function detailPenyedia($id)
    {
        try {
            $result = $this->penyediaService->detailPenyedia($id);
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

    public function detailPenyediaByUserId($id)
    {
        try {
            $result = $this->penyediaService->detailPenyediaByUserId($id);
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
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'hp' => 'required',
                'wilayah' => 'required',
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
            $validateData = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required',
                'nama' => 'required',
                'alamat' => 'required',
                'hp' => 'required',
                'wilayah' => 'required',
            ]);
            $result = $this->penyediaService->updatePenyedia($request, $id);
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
