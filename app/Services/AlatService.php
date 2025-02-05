<?php

namespace App\Services;

use App\Models\Alat;
use App\Repositories\AlatRepository;
use Illuminate\Support\Facades\Storage;

class AlatService
{
    protected $alatRepository;

    public function __construct(AlatRepository $alatRepository)
    {
        $this->alatRepository = $alatRepository;
    }

    public function listAlat()
    {
        return $this->alatRepository->listAlat();
    }

    public function createAlat($dataRequest)
    {
        // Proses upload foto
        $fotoAlatTani = null;

        if (isset($dataRequest['foto_alat']) && $dataRequest['foto_alat']->isValid()) {
            $file = $dataRequest['foto_alat'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('alat_tani', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            // Tulis ulang file dengan konten terenkripsi
            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file untuk database
            $fotoAlatTani = $filePath;
        }

        $request = [
            'jenis_alat' => $dataRequest['jenis_alat'],
            'nama_alat' => $dataRequest['nama_alat'],
            'deskripsi_alat' => $dataRequest['deskripsi_alat'],
            'harga_sewa_alat' => $dataRequest['harga_sewa_alat'],
            'jumlah_alat' => $dataRequest['jumlah_alat'],
            'foto_alat' => $fotoAlatTani,
            'status' => $dataRequest['status'],
            'penyedia_id' => $dataRequest['penyedia_id']

        ];
        return $this->alatRepository->createAlat($request);
    }

    public function updateAlat($dataRequest, $id)
    {
        // Ambil data kelompok tani saat ini dari repository
        $alat = $this->alatRepository->find($id);

        // Proses upload foto baru jika ada
        $fotoAlatTani = $alat->foto_alat; // Simpan nama file lama secara default

        if (isset($dataRequest['foto_alat']) && $dataRequest['foto_alat']->isValid()) {
            // Hapus gambar lama jika ada
            if ($alat->foto_alat) {
                Storage::disk('public')->delete($alat->foto_alat);
            }

            $file = $dataRequest['foto_alat'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('alat_tani', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file baru untuk database
            $fotoAlatTani = $filePath;
        }

        $request = [
            'jenis_alat' => $dataRequest['jenis_alat'],
            'nama_alat' => $dataRequest['nama_alat'],
            'deskripsi_alat' => $dataRequest['deskripsi_alat'],
            'harga_sewa_alat' => $dataRequest['harga_sewa_alat'],
            'jumlah_alat' => $dataRequest['jumlah_alat'],
            'foto_alat' => $fotoAlatTani,
            'status' => $dataRequest['status'],
            'penyedia_id' => $dataRequest['penyedia_id']
        ];

        return $this->alatRepository->updateAlat($request, $id);
    }

    public function deleteAlat($id)
    {
        // Ambil data kelompok tani saat ini dari repository
        $alat = $this->alatRepository->find($id);
        if ($alat->foto_alat) {
            Storage::disk('public')->delete($alat->foto_alat);
        }
        return $this->alatRepository->deleteAlat($id);
    }
}
