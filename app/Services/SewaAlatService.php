<?php

namespace App\Services;

use App\Repositories\SewaAlatRepository;
use App\Repositories\AlatRepository;
use App\Repositories\PenyediaRepository;

class SewaAlatService
{
    private $sewaAlatRepository;

    public function __construct(SewaAlatRepository $sewaAlatRepository)
    {
        $this->sewaAlatRepository = $sewaAlatRepository;
    }

    public function listSewaAlatByKelompokTani($id)
    {
        return $this->sewaAlatRepository->listSewaAlatByKelompokTani($id);
    }

    public function listSewaAlatByBhabinkamtibmas($id)
    {
        return $this->sewaAlatRepository->listSewaAlatByBhabinkamtibmas($id);
    }

    public function listSewaAlatByPenyedia($id)
    {
        return $this->sewaAlatRepository->listSewaAlatByPenyedia($id);
    }

    public function pengajuanSewaAlat($data)
    {
        return $this->sewaAlatRepository->pengajuanSewaAlat($data);
    }

    public function pengajuanPengembalianSewaAlat($id)
    {
        try {
            $user = auth()->user()->id;
            $alat = $this->sewaAlatRepository->find($id);

            if ($user == $alat->id_babinsa) {
                return $this->sewaAlatRepository->pengajuanPengembalianSewaAlat($id);
            } else {
                return [
                    'id' => '0',
                    'data' => 'anda bukan bhabinkamtibmas yang menyewa alat'
                ];
            }
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menyetujui pengajuan sewa alat'
            ];
        }
    }

    public function aksiPengajuanSewaAlat($data, $id)
    {
        try {
            return $this->sewaAlatRepository->aksiPengajuanSewaAlat($data, $id);
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
