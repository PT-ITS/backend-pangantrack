<?php

namespace App\Services;

use App\Repositories\JenisPanenRepository;

class JenisPanenService
{
    private $jenisPanenRepository;

    public function __construct(JenisPanenRepository $jenisPanenRepository)
    {
        $this->jenisPanenRepository = $jenisPanenRepository;
    }

    public function listJenisPanen()
    {
        return $this->jenisPanenRepository->listJenisPanen();
    }

    public function createJenisPanen($dataRequest)
    {
        // Proses upload foto
        $fotoJenisTanaman = null;

        if (isset($dataRequest['foto_jenis']) && $dataRequest['foto_jenis']->isValid()) {
            $file = $dataRequest['foto_jenis'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('jenis_tanaman/foto_jenis', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            // Enkripsi konten file
            $encryptedContent = Crypt::encrypt($fileContent);

            // Tulis ulang file dengan konten terenkripsi
            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file untuk database
            $fotoJenisTanaman = $filePath;
        }

        $request = [
            'name_jenis_panen' => $dataRequest['name_jenis_panen'],
            'foto_jenis' => $dataRequest['foto_jenis']
        ];
        return $this->jenisPanenRepository->createJenisPanen($request);
    }

    public function updateJenisPanen($dataRequest)
    {
        // Ambil data kelompok tani saat ini dari repository
        $jenisTanaman = $this->jenisPanenRepository->find($id);
        
        // Proses upload foto baru jika ada
        $fotoJenisTanaman = $jenisTanaman->foto_jenis; // Simpan nama file lama secara default

        if (isset($dataRequest['foto_jenis']) && $dataRequest['foto_jenis']->isValid()) {
            // Hapus gambar lama jika ada
            if ($jenisTanaman->foto_jenis) {
                Storage::disk('public')->delete($jenisTanaman->foto_jenis);
            }

            $file = $dataRequest['foto_jenis'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('jenis_tanaman/foto_jenis', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file baru untuk database
            $fotoJenisTanaman = $filePath;
        }

        $request = [
            'name_jenis_panen' => $dataRequest['name_jenis_panen'],
            'foto_jenis' => $fotoJenisTanaman
        ];
        return $this->jenisPanenRepository->updateJenisPanen($request);
    }

    public function deleteJenisPanen($id)
    {
        return $this->jenisPanenRepository->deleteJenisPanen($id);
    }
}