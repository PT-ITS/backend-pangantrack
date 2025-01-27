<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SewaAlatService;

class SewaAlatController extends Controller
{
    private $sewaAlatService;

    public function __construct(SewaAlatService $sewaAlatService)
    {
        $this->sewaAlatService = $sewaAlatService;
    }

    public function listSewaAlatByKelompokTani($id)
    {
        try {
            $result = $this->sewaAlatService->listSewaAlatByKelompokTani($id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat',
            ]);
        }
    }

    public function pengajuanSewaAlat(Request $request)
    {
        try {
            $validateData = $request->validate([
                'tanggal_sewa' => 'required',
                'tanggal_kembali' => 'required',
                'status' => 'required',
                'id_alat' => 'required',
                'id_kelompok' => 'required',
                'id_babinsa' => 'required',
            ]);

            $result = $this->sewaAlatService->pengajuanSewaAlat($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data sewa alat',
            ]);
        }
    }

    public function aksiPengajuanSewaAlat($id)
    {
        try {
            $validateData = $request->validate([
                'id' => 'required',
                'status' => 'required',
            ]);
            $result = $this->sewaAlatService->aksiPengajuanSewaAlat($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menyetujui pengajuan sewa alat',
            ]);
        }
    }


    public function updateSewaAlat(Request $request)
    {
        try {
            $validateData = $request->validate([
                'id' => 'required',
                'tanggal_sewa' => 'required',
                'tanggal_kembali' => 'required',
                'status' => 'required',
                'id_alat' => 'required',
                'id_kelompok' => 'required',
                'id_babinsa' => 'required',
            ]);
            $result = $this->sewaAlatService->updateSewaAlat($validateData);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data sewa alat',
            ]);
        }
    }
    
    public function deleteSewaAlat($id)
    {
        try {
            $result = $this->sewaAlatService->deleteSewaAlat($id);
            return response()->json([
                'id' => $result['id'],
                'data' => $result['data'],
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data sewa alat',
            ]);
        }
    }
}
