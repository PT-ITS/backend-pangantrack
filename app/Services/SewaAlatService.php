<?php

namespace App\Services;

use App\Repositories\SewaAlatRepository;
use App\Repositories\PenyediaRepository;

class SewaAlatService
{
    private $sewaAlatRepository;
    private $penyediaRepository;

    public function __construct(SewaAlatRepository $sewaAlatRepository, PenyediaRepository $penyediaRepository)
    {
        $this->sewaAlatRepository = $sewaAlatRepository;
        $this->penyediaRepository = $penyediaRepository;
    }

    public function listSewaAlatByKelompokTani($id)
    {
        return $this->sewaAlatRepository->listSewaAlatByKelompokTani($id);
    }

    public function pengajuanSewaAlat($data)
    {
        return $this->sewaAlatRepository->pengajuanSewaAlat($data);
    }

    public function aksiPengajuanSewaAlat($data, $id)
    {
        try {
            $user = auth()->user()->id;
            $alat = $this->sewaAlatRepository->find($id);
            $penyedia = $this->penyediaRepository->find($alat->penyedia_id);

            if ($user == $penyedia->id_pj) {
                return $this->sewaAlatRepository->aksiPengajuanSewaAlat($data, $id);
            } else {
                return [
                    'id' => '0',
                    'data' => 'anda bukan pemilik penyedia alat'
                ];
            }
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menyetujui pengajuan sewa alat'
            ];
        }
    }

    public function updateSewaAlat($data)
    {
        return $this->sewaAlatRepository->updateSewaAlat($data);
    }

    public function deleteSewaAlat($id)
    {
        return $this->sewaAlatRepository->deleteSewaAlat($id);
    }
}
