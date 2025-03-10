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

    public function listAvailableYearsPanen()
    {
        try {
            $result = $this->dashboardService->listAvailableYearsPanen();
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

    public function listAvailableYearsBantuan()
    {
        try {
            $result = $this->dashboardService->listAvailableYearsBantuan();
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

    public function listLineChartPanenAdmin(Request $request)
    {
        try {
            $month = $request->query('month');
            $year = $request->query('year');

            $result = $this->dashboardService->listLineChartPanenAdmin($month, $year);

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

    public function listLineChartBantuanAdmin(Request $request)
    {
        try {
            $month = $request->query('month');
            $year = $request->query('year');

            $result = $this->dashboardService->listLineChartBantuanAdmin($month, $year);

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

    public function listLineChartPanenAdminStartEnd(Request $request)
    {
        try {
            $startMonth = $request->query('start_month');
            $endMonth = $request->query('end_month');
            $year = $request->query('year');

            $result = $this->dashboardService->listLineChartPanenAdminStartEnd($startMonth, $endMonth, $year);

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

    public function listLineChartBantuanAdminStartEnd(Request $request)
    {
        try {
            $startMonth = $request->query('start_month');
            $endMonth = $request->query('end_month');
            $year = $request->query('year');

            $result = $this->dashboardService->listLineChartBantuanAdminStartEnd($startMonth, $endMonth, $year);

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
