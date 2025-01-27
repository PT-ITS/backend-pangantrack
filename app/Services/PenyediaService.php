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

    public function createPenyedia($data)
    {
        return $this->penyediaRepository->createPenyedia($data);
    }

    public function updatePenyedia($id, $data)
    {
        return $this->penyediaRepository->updatePenyedia($id, $data);
    }

    public function deletePenyedia($id)
    {
        return $this->penyediaRepository->deletePenyedia($id);
    }
}