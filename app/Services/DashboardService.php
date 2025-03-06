<?php

namespace App\Services;

use App\Repositories\DashboardRepository;

class DashboardService
{
    private $dashboardRepository;

    public function __construct(DashboardRepository $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function listAvailableYearsPanen()
    {
        return $this->dashboardRepository->listAvailableYearsPanen();
    }

    public function listAvailableYearsBantuan()
    {
        return $this->dashboardRepository->listAvailableYearsBantuan();
    }

    public function listLineChartPanenAdmin($month = null, $year = null)
    {
        try {
            return $this->dashboardRepository->listLineChartPanenAdmin($month, $year);
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage(),
            ];
        }
    }

    public function listLineChartBantuanAdmin($month = null, $year = null)
    {
        try {
            return $this->dashboardRepository->listLineChartBantuanAdmin($month, $year);
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage(),
            ];
        }
    }

    public function listLineChartPanenAdminStartEnd($startMonth = null, $endMonth = null, $year = null)
    {
        try {
            return $this->dashboardRepository->listLineChartPanenAdminStartEnd($startMonth, $endMonth, $year);
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage(),
            ];
        }
    }

    public function listLineChartBantuanAdminStartEnd($startMonth = null, $endMonth = null, $year = null)
    {
        try {
            return $this->dashboardRepository->listLineChartBantuanAdminStartEnd($startMonth, $endMonth, $year);
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "statusCode" => 401,
                "data" => $e->getMessage(),
            ];
        }
    }

    // public function listPieChartPanenAdmin()
    // {
    //     try {
    //         $response = $this->dashboardRepository->listPieChartPanenAdmin();

    //         // Convert the JSON response to an array
    //         $responseArray = $response->getData(true); // getData(true) converts the response to an array

    //         return $responseArray;
    //     } catch (\Exception $e) {
    //         return [
    //             "id" => '0',
    //             "statusCode" => 401,
    //             "data" => $e->getMessage(),
    //         ];
    //     }
    // }
}
