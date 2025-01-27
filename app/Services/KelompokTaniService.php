<?php

namespace App\Services;

use App\Repositories\KelompokTaniRepository;

class KelompokTaniService
{
    private $kelompokTaniRepository;   

    public function __construct(KelompokTaniRepository $kelompokTaniRepository)
    {
        $this->kelompokTaniRepository = $kelompokTaniRepository;
    }

    public function listKelompokTani()
    {
        return $this->kelompokTaniRepository->listKelompokTani();
    }

    public function createKelompokTani($dataRequest)
    {
        // Proses upload foto
        $fotoKelompokName = null;

        if (isset($dataRequest['foto_kelompok']) && $dataRequest['foto_kelompok']->isValid()) {
            $file = $dataRequest['foto_kelompok'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('kelompok_tani/foto_kelompok', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            // Enkripsi konten file
            $encryptedContent = Crypt::encrypt($fileContent);

            // Tulis ulang file dengan konten terenkripsi
            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file untuk database
            $fotoKelompokName = $filePath;
        }

        $request = [
            'name_kelompok' => $dataRequest['name_kelompok'],
            'alamat_kelompok' => $dataRequest['alamat_kelompok'],
            'ketua_kelompok' => $dataRequest['ketua_kelompok'],
            'foto_kelompok' => $fotoKelompokName,
            'status_kelompok' => $dataRequest['status_kelompok'],
        ];
        return $this->kelompokTaniRepository->createKelompokTani($request);
    }

    public function updateKelompokTani($dataRequest, $id)
    {
        // Ambil data kelompok tani saat ini dari repository
        $kelompokTani = $this->kelompokTaniRepository->find($id);
        
        // Proses upload foto baru jika ada
        $fotoKelompokName = $kelompokTani->foto_kelompok; // Simpan nama file lama secara default

        if (isset($dataRequest['foto_kelompok']) && $dataRequest['foto_kelompok']->isValid()) {
            // Hapus gambar lama jika ada
            if ($kelompokTani->foto_kelompok) {
                Storage::disk('public')->delete($kelompokTani->foto_kelompok);
            }

            $file = $dataRequest['foto_kelompok'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('kelompok_tani/foto_kelompok', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file baru untuk database
            $fotoKelompokName = $filePath;
        }

        $request = [
            'name_kelompok' => $dataRequest['name_kelompok'],
            'alamat_kelompok' => $dataRequest['alamat_kelompok'],
            'ketua_kelompok' => $dataRequest['ketua_kelompok'],
            'status_kelompok' => $dataRequest['status_kelompok'],
            'foto_kelompok' => $fotoKelompokName,
        ];

        return $this->kelompokTaniRepository->updateKelompokTani($request, $id);
    }

    public function deleteKelompokTani($id)
    {
        // Ambil data kelompok tani saat ini dari repository
        $kelompokTani = $this->kelompokTaniRepository->find($id);
        if ($kelompokTani->foto_kelompok) {
            Storage::disk('public')->delete($kelompokTani->foto_kelompok);
        }
        return $this->kelompokTaniRepository->deleteKelompokTani($id);
    }

}