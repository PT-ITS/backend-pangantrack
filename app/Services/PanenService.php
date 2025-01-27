<?php

namespace App\Services;

use App\Repositories\PanenRepository;

class PanenService
{
    protected $panenRepository;

    public function __construct(PanenRepository $panenRepository)
    {
        $this->panenRepository = $panenRepository;
    }

    public function listPanenByPetani($id)
    {
        return $this->panenRepository->listPanenByPetani($id);
    }

    public function createPanen($data)
    {
        return $this->panenRepository->createPanen($data);
    }
    
    public function updatePanen($data, $id)
    {
        return $this->panenRepository->updatePanen($data, $id);
    }

    public function deletePanen($id)
    {
        return $this->panenRepository->deletePanen($id);
    }
}