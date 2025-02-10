<?php

namespace App\Services;

use App\Repositories\AdminPoldaRepository;

class AdminPoldaService
{
    protected $adminPoldaRepository;

    public function __construct(AdminPoldaRepository $adminPoldaRepository)
    {
        $this->adminPoldaRepository = $adminPoldaRepository;
    }

    public function detailAdminPolda($id)
    {
        return $this->adminPoldaRepository->detailAdminPolda($id);
    }

    public function detailAdminPoldaByUserId($id)
    {
        return $this->adminPoldaRepository->detailAdminPoldaByUserId($id);
    }

    public function listAdminPolda()
    {
        return $this->adminPoldaRepository->listAdminPolda();
    }

    public function createAdminPolda($data)
    {
        return $this->adminPoldaRepository->createAdminPolda($data);
    }

    public function updateAdminPolda($data, $id)
    {
        return $this->adminPoldaRepository->updateAdminPolda($data, $id);
    }

    public function deleteAdminPolda($id)
    {
        return $this->adminPoldaRepository->deleteAdminPolda($id);
    }
}
