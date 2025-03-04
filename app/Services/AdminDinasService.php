<?php

namespace App\Services;

use App\Repositories\AdminDinasRepository;

class AdminDinasService
{
    protected $adminDinasRepository;

    public function __construct(AdminDinasRepository $adminDinasRepository)
    {
        $this->adminDinasRepository = $adminDinasRepository;
    }

    public function detailAdminDinas($id)
    {
        return $this->adminDinasRepository->detailAdminDinas($id);
    }

    public function detailAdminDinasByUserId($id)
    {
        return $this->adminDinasRepository->detailAdminDinasByUserId($id);
    }

    public function listAdminDinas()
    {
        return $this->adminDinasRepository->listAdminDinas();
    }

    public function createAdminDinas($data)
    {
        return $this->adminDinasRepository->createAdminDinas($data);
    }

    public function updateAdminDinas($data, $id)
    {
        return $this->adminDinasRepository->updateAdminDinas($data, $id);
    }

    public function deleteAdminDinas($id)
    {
        return $this->adminDinasRepository->deleteAdminDinas($id);
    }
}
