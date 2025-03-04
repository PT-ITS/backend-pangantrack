<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminDinasService;
use Illuminate\Support\Facades\Validator;

class AdminDinasController extends Controller
{
    private $adminDinasService;

    public function __construct(AdminDinasService $adminDinasService)
    {
        $this->adminDinasService = $adminDinasService;
    }

    public function detailAdminDinas($id)
    {
        try {
            $result = $this->adminDinasService->detailAdminDinas($id);
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

    public function detailAdminDinasByUserId($id)
    {
        try {
            $result = $this->adminDinasService->detailAdminDinasByUserId($id);
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

    public function listAdminDinas()
    {
        try {
            $result = $this->adminDinasService->listAdminDinas();
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

    public function createAdminDinas(Request $request)
    {
        try {
            $validateData = $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'nama_admin' => 'required',
                'nip_admin' => 'required',
                'jabatan_admin' => 'required',
                'tempat_dinas_admin' => 'required',
                'alamat_admin' => 'required',
                'hp_admin' => 'required',
            ]);
            $result = $this->adminDinasService->createAdminDinas($validateData);
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

    public function updateAdminDinas(Request $request, $id)
    {
        try {
            $validateData = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $id,
                'password' => 'required',
                'nama_admin' => 'required',
                'nip_admin' => 'required',
                'jabatan_admin' => 'required',
                'tempat_dinas_admin' => 'required',
                'alamat_admin' => 'required',
                'hp_admin' => 'required',
            ]);
            $result = $this->adminDinasService->updateAdminDinas($request, $id);
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

    public function deleteAdminDinas($id)
    {
        try {
            $result = $this->adminDinasService->deleteAdminDinas($id);
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
