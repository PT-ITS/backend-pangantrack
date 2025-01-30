<?php

namespace App\Services;

use App\Models\JenisPanen;
use App\Repositories\JenisPanenRepository;
use Illuminate\Support\Facades\Storage;

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
            $filePath = $file->store('jenis_panen', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            // Tulis ulang file dengan konten terenkripsi
            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file untuk database
            $fotoJenisTanaman = $filePath;
        }

        $request = [
            'jenis_panen' => $dataRequest['jenis_panen'],
            'foto_jenis' => $fotoJenisTanaman
        ];
        return $this->jenisPanenRepository->createJenisPanen($request);
    }

    public function updateJenisPanen($dataRequest, $id)
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
            $filePath = $file->store('jenis_panen', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file baru untuk database
            $fotoJenisTanaman = $filePath;
        }

        $request = [
            'jenis_panen' => $dataRequest['jenis_panen'],
            'foto_jenis' => $fotoJenisTanaman
        ];
        return $this->jenisPanenRepository->updateJenisPanen($request, $id);
    }

    public function deleteJenisPanen($id)
    {
        // Ambil data kelompok tani saat ini dari repository
        $jenis = $this->jenisPanenRepository->find($id);
        if ($jenis->foto_jenis) {
            Storage::disk('public')->delete($jenis->foto_jenis);
        }
        return $this->jenisPanenRepository->deleteJenisPanen($id);
    }
}
