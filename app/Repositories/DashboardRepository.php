<?php

namespace App\Repositories;

use App\Models\AdminLanud;
use App\Models\JenisPanen;
use App\Models\Panen;
use App\Models\KelompokTani;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    private $jenisPanenModel;
    private $panenModel;
    private $kelompokTaniModel;

    public function __construct(JenisPanen $jenisPanenModel, Panen $panenModel, KelompokTani $kelompokTaniModel)
    {
        $this->jenisPanenModel = $jenisPanenModel;
        $this->panenModel = $panenModel;
        $this->kelompokTaniModel = $kelompokTaniModel;
    }

    public function listLineChartPanenAdmin()
    {
        try {
            // Fetch all unique id_kab_kota
            $kabKotaIds = KelompokTani::distinct()->pluck('id_kab_kota');

            if ($kabKotaIds->isEmpty()) {
                return response()->json([
                    "id" => '0',
                    "statusCode" => 404,
                    "data" => 'Data line chart not found'
                ]);
            }

            $result = [];

            foreach ($kabKotaIds as $id_kab_kota) {
                // Get kelompok_tani IDs for this id_kab_kota
                $kelompokTaniIds = KelompokTani::where('id_kab_kota', $id_kab_kota)->pluck('id');

                // Get jumlah_panen per jenis_panen
                $daftarJenisPanen = JenisPanen::whereIn(
                    'id',
                    Panen::whereIn('kelompok_tani_id', $kelompokTaniIds)->pluck('jenis_panen_id')
                )
                    ->withSum(['panens' => function ($query) use ($kelompokTaniIds) {
                        $query->whereIn('kelompok_tani_id', $kelompokTaniIds);
                    }], 'jumlah_panen')
                    ->get()
                    ->map(function ($item) use ($id_kab_kota) {
                        return [
                            'id_kab_kota' => $id_kab_kota,
                            'jenis_panen' => $item->jenis_panen,
                            'jumlah_panen' => $item->panens_sum_jumlah_panen
                        ];
                    });

                $result = array_merge($result, $daftarJenisPanen->toArray());
            }

            return response()->json([
                "id" => '1',
                "statusCode" => 200,
                "data" => $result,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage()
            ]);
        }
    }


    // public function listPieChartPanenAdmin()
    // {
    //     try {
    //         $kabKotaIds = KelompokTani::distinct()->pluck('id_kab_kota');

    //         if ($kabKotaIds->isEmpty()) {
    //             return response()->json([
    //                 "id" => '0',
    //                 "statusCode" => 404,
    //                 "data" => 'Data line chart not found'
    //             ]);
    //         }

    //         $result = [];

    //         foreach ($kabKotaIds as $id_kab_kota) {
    //             // Get kelompok_tani IDs for this id_kab_kota
    //             $kelompokTaniIds = KelompokTani::where('id_kab_kota', $id_kab_kota)->pluck('id');

    //             // Get jumlah_panen per jenis_panen
    //             $daftarJenisPanen = JenisPanen::whereIn(
    //                 'id',
    //                 Panen::whereIn('kelompok_tani_id', $kelompokTaniIds)->pluck('jenis_panen_id')
    //             )
    //                 ->withSum(['panens' => function ($query) use ($kelompokTaniIds) {
    //                     $query->whereIn('kelompok_tani_id', $kelompokTaniIds);
    //                 }], 'jumlah_panen')
    //                 ->get()
    //                 ->map(function ($item) use ($id_kab_kota) {
    //                     return [
    //                         'id_kab_kota' => $id_kab_kota,
    //                         'jenis_panen' => $item->jenis_panen,
    //                         'jumlah_panen' => $item->panens_sum_jumlah_panen
    //                     ];
    //                 });

    //             $result = array_merge($result, $daftarJenisPanen->toArray());
    //         }

    //         return response()->json([
    //             "id" => '1',
    //             "statusCode" => 200,
    //             "data" => $result,
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             "id" => '0',
    //             "statusCode" => 401,
    //             "data" => $e->getMessage()
    //         ]);
    //     }
    // }
}
