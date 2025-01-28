<?php

namespace App\Services;

use App\Repositories\PenyediaRepository;

class PenyediaService
{
    private $penyediaRepository;

    public function __construct(PenyediaRepository $penyediaRepository)
    {
        $this->penyediaRepository = $penyediaRepository;
    }

    public function listPenyedia()
    {
        return $this->penyediaRepository->listPenyedia();
    }

    public function createPenyedia($requestData)
    {
        return $this->penyediaRepository->createPenyedia($requestData);
    }

    public function updatePenyedia($requestData, $id)
    {
        return $this->penyediaRepository->updatePenyedia($requestData, $id);
    }

    public function deletePenyedia($id)
    {
        return $this->penyediaRepository->deletePenyedia($id);
    }
}
