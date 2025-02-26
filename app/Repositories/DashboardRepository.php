<?php

namespace App\Repositories;

use App\Models\AdminLanud;
use App\Models\Bantuan;
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

    public function listAvailableYearsPanen()
    {
        try {
            $years = Panen::selectRaw('YEAR(tanggal_panen) as year')
                ->distinct()
                ->pluck('year')
                ->filter() // Removes null values
                ->values(); // Reset array indexes

            return [
                "id" => '1',
                "statusCode" => 200,
                "data" => $years,
            ];
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage(),
            ];
        }
    }

    public function listAvailableYearsBantuan()
    {
        try {
            $years = Bantuan::select('tahun') // Select the year directly
                ->distinct()
                ->pluck('tahun')
                ->filter() // Removes null values
                ->values(); // Reset array indexes

            return [
                "id" => '1',
                "statusCode" => 200,
                "data" => $years,
            ];
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage(),
            ];
        }
    }

    public function listLineChartPanenAdmin($month = null, $year = null)
    {
        try {
            $query = Panen::query();

            if ($month) {
                $query->whereMonth('tanggal_panen', $month);
            }
            if ($year) {
                $query->whereYear('tanggal_panen', $year);
            }

            // Fetch all unique id_kab_kota
            $kabKotaIds = KelompokTani::distinct()->pluck('id_kab_kota');

            if ($kabKotaIds->isEmpty()) {
                return [
                    "id" => '0',
                    "statusCode" => 404,
                    "data" => 'Data line chart not found'
                ];
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
                    ->withSum(['panens' => function ($query) use ($kelompokTaniIds, $month, $year) {
                        $query->whereIn('kelompok_tani_id', $kelompokTaniIds);
                        if ($month) {
                            $query->whereMonth('tanggal_panen', $month);
                        }
                        if ($year) {
                            $query->whereYear('tanggal_panen', $year);
                        }
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

            return [
                "id" => '1',
                "statusCode" => 200,
                "data" => $result,
            ];
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage()
            ];
        }
    }

    public function listLineChartBantuanAdmin($month = null, $year = null)
    {
        try {
            $query = Bantuan::select(
                'id_kab_kota',
                'jenis_bantuan',
                DB::raw("SUM(jumlah_bantuan) as total_bantuan"),
                'satuan_bantuan'
            )
                ->groupBy('id_kab_kota', 'jenis_bantuan', 'satuan_bantuan');

            if ($month) {
                $query->where('bulan', $month);
            }
            if ($year) {
                $query->where('tahun', $year);
            }

            $result = $query->get()->map(function ($item) {
                return [
                    'id_kab_kota' => $item->id_kab_kota,
                    'jenis_bantuan' => $item->jenis_bantuan,
                    'jumlah_bantuan' => (int) $item->total_bantuan, // Convert to number
                    'satuan_bantuan' => $item->satuan_bantuan,
                ];
            });

            return [
                "id" => '1',
                "statusCode" => 200,
                "data" => $result,
            ];
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage()
            ];
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
