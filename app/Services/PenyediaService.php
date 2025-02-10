<?php

namespace App\Services;

use App\Repositories\PenyediaRepository;

class PenyediaService
{
    protected $penyediaRepository;

    public function __construct(PenyediaRepository $penyediaRepository)
    {
        $this->penyediaRepository = $penyediaRepository;
    }

    public function detailPenyedia($id)
    {
        return $this->penyediaRepository->detailPenyedia($id);
    }

    public function detailPenyediaByUserId($id)
    {
        return $this->penyediaRepository->detailPenyediaByUserId($id);
    }

    public function listPenyedia()
    {
        return $this->penyediaRepository->listPenyedia();
    }

    public function createPenyedia($data)
    {
        return $this->penyediaRepository->createPenyedia($data);
    }

    public function updatePenyedia($data, $id)
    {
        return $this->penyediaRepository->updatePenyedia($data, $id);
    }

    public function deletePenyedia($id)
    {
        return $this->penyediaRepository->deletePenyedia($id);
    }
}
