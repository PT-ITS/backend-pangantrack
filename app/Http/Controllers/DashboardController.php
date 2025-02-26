<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DashboardService;

class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function listLineChartPanenAdmin()
    {
        try {
            $result = $this->dashboardService->listLineChartPanenAdmin();
            return response()->json(
                [
                    'id' => $result['id'],
                    'data' => $result['data']
                ],
                $result['statusCode']
            );
        } catch (\Throwable $th) {
            return response()->json(
                [
                    'id' => '0',
                    'data' => $th->getMessage()
                ],
                401
            );
        }
    }

    // public function listPieChartPanenAdmin()
    // {
    //     try {
    //         $result = $this->dashboardService->listPieChartPanenAdmin();
    //         return response()->json(
    //             [
    //                 'id' => $result['id'],
    //                 'data' => $result['data']
    //             ],
    //             $result['statusCode']
    //         );
    //     } catch (\Throwable $th) {
    //         return response()->json(
    //             [
    //                 'id' => '0',
    //                 'data' => $th->getMessage()
    //             ],
    //             401
    //         );
    //     }
    // }
}
