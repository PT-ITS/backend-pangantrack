<?php

namespace App\Services;

use App\Repositories\BhabinkamtibmasRepository;

class BhabinkamtibmasService
{
    protected $bhabinkamtibmasRepository;

    public function __construct(BhabinkamtibmasRepository $bhabinkamtibmasRepository)
    {
        $this->bhabinkamtibmasRepository = $bhabinkamtibmasRepository;
    }

    public function detailBhabinkamtibmas($id)
    {
        return $this->bhabinkamtibmasRepository->detailBhabinkamtibmas($id);
    }

    public function listBhabinkamtibmas()
    {
        return $this->bhabinkamtibmasRepository->listBhabinkamtibmas();
    }

    public function createBhabinkamtibmas($data)
    {
        return $this->bhabinkamtibmasRepository->createBhabinkamtibmas($data);
    }

    public function updateBhabinkamtibmas($data, $id)
    {
        return $this->bhabinkamtibmasRepository->updateBhabinkamtibmas($data, $id);
    }

    public function deleteBhabinkamtibmas($id)
    {
        return $this->bhabinkamtibmasRepository->deleteBhabinkamtibmas($id);
    }
}
