<?php

namespace App\Services;

use App\Repositories\BantuanRepository;

class BantuanService
{
    protected $bantuanRepository;

    public function __construct(BantuanRepository $bantuanRepository)
    {
        $this->bantuanRepository = $bantuanRepository;
    }

    public function detailBantuan($id)
    {
        return $this->bantuanRepository->detailBantuan($id);
    }

    public function listBantuan()
    {
        return $this->bantuanRepository->listBantuan();
    }

    public function createBantuan($data)
    {
        return $this->bantuanRepository->createBantuan($data);
    }

    public function updateBantuan($data, $id)
    {
        return $this->bantuanRepository->updateBantuan($data, $id);
    }

    public function deleteBantuan($id)
    {
        return $this->bantuanRepository->deleteBantuan($id);
    }
}
