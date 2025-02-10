<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminPoldaService;

class AdminPoldaController extends Controller
{
    private $adminPoldaService;

    public function __construct(AdminPoldaService $adminPoldaService)
    {
        $this->adminPoldaService = $adminPoldaService;
    }

    public function detailAdminPolda($id)
    {
        try {
            $result = $this->adminPoldaService->detailAdminPolda($id);
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

    public function detailAdminPoldaByUserId($id)
    {
        try {
            $result = $this->adminPoldaService->detailAdminPoldaByUserId($id);
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

    public function listAdminPolda()
    {
        try {
            $result = $this->adminPoldaService->listAdminPolda();
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

    public function createAdminPolda(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'nama_admin' => 'required',
                'nrp_admin' => 'required',
                'jabatan_admin' => 'nullable',
                'tempat_dinas_admin' => 'nullable',
                'alamat_admin' => 'required',
                'hp_admin' => 'required',
            ]);
            $result = $this->adminPoldaService->createAdminPolda($validateData);
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

    public function updateAdminPolda(Request $request, $id)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required',
                'nama_admin' => 'required',
                'nrp_admin' => 'required',
                'jabatan_admin' => 'nullable',
                'tempat_dinas_admin' => 'nullable',
                'alamat_admin' => 'required',
                'hp_admin' => 'required',
            ]);
            $result = $this->adminPoldaService->updateAdminPolda($validateData, $id);
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

    public function deleteAdminPolda($id)
    {
        try {
            $result = $this->adminPoldaService->deleteAdminPolda($id);
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
