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

    public function listLineChartPanenAdmin()
    {
        try {
            $response = $this->dashboardRepository->listLineChartPanenAdmin();

            // Convert the JSON response to an array
            $responseArray = $response->getData(true); // getData(true) converts the response to an array

            return $responseArray;
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
