<?php

namespace App\Services;

use App\Repositories\PetaniRepository;

class PetaniService
{
    private $petaniRepository;

    public function __construct(PetaniRepository $petaniRepository)
    {
        $this->petaniRepository = $petaniRepository;
    }
    
    public function listPetaniByKelompok($id)
    {
        return $this->petaniRepository->listPetaniByKelompok($id);
    }

    public function createPetani($data)
    {
        return $this->petaniRepository->createPetani($data);
    }

    public function updatePetani($data, $id)
    {
        return $this->petaniRepository->updatePetani($data, $id);
    }
    
    public function deletePetani($id)
    {
        return $this->petaniRepository->deletePetani($id);
    }
}