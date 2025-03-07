<?php

namespace App\Services;

use App\Repositories\KelompokTaniRepository;
use Illuminate\Support\Facades\Storage;

class KelompokTaniService
{
    private $kelompokTaniRepository;

    public function __construct(KelompokTaniRepository $kelompokTaniRepository)
    {
        $this->kelompokTaniRepository = $kelompokTaniRepository;
    }

    public function detailPanenByKabKota($id)
    {
        return $this->kelompokTaniRepository->detailPanenByKabKota($id);
    }

    public function detailPanenByBhabin($id)
    {
        return $this->kelompokTaniRepository->detailPanenByBhabin($id);
    }

    public function detailPanen()
    {
        return $this->kelompokTaniRepository->detailPanen();
    }

    public function detailKelompokTaniByKabKota($id)
    {
        return $this->kelompokTaniRepository->detailKelompokTaniByKabKota($id);
    }

    public function detailKelompokTani($id)
    {
        return $this->kelompokTaniRepository->detailKelompokTani($id);
    }

    public function listKelompokTani()
    {
        return $this->kelompokTaniRepository->listKelompokTani();
    }

    public function listKelompokTaniPagination($dataRequest)
    {
        return $this->kelompokTaniRepository->listKelompokTaniPagination($dataRequest);
    }

    public function listKelompokTaniByBhabinkamtibmas($id)
    {
        return $this->kelompokTaniRepository->listKelompokTaniByBhabinkamtibmas($id);
    }

    public function listKelompokTaniByKabKota($id)
    {
        return $this->kelompokTaniRepository->listKelompokTaniByKabKota($id);
    }

    public function listKelompokTaniByKecamatan($kecamatan)
    {
        return $this->kelompokTaniRepository->listKelompokTaniByKecamatan($kecamatan);
    }

    public function createKelompokTani($dataRequest)
    {
        // Proses upload foto
        $fotoKelompokName = null;

        if (isset($dataRequest['foto_kelompok']) && $dataRequest['foto_kelompok']->isValid()) {
            $file = $dataRequest['foto_kelompok'];

            // Generate path penyimpanan dengan nama unik
            $filePath = $file->store('kelompok_tani', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            // Tulis ulang file dengan konten terenkripsi
            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file untuk database
            $fotoKelompokName = $filePath;
        }

        $request = [
            'nama_kelompok' => $dataRequest['nama_kelompok'],
            'status_kelompok' => $dataRequest['status_kelompok'],
            'alamat_kelompok' => $dataRequest['alamat_kelompok'],
            'ketua_kelompok' => $dataRequest['ketua_kelompok'],
            'alamat_ketua' => $dataRequest['alamat_ketua'],
            'hp_ketua' => $dataRequest['hp_ketua'],
            'foto_kelompok' => $fotoKelompokName,
            'jumlah_anggota' => $dataRequest['jumlah_anggota'],
            'id_kab_kota' => $dataRequest['id_kab_kota'],
            'kecamatan' => $dataRequest['kecamatan'],
            'desa' => $dataRequest['desa'],
            'luas_lahan' => $dataRequest['luas_lahan'],
            'koordinat' => $dataRequest['koordinat'],
            'user_id' => $dataRequest['user_id'],
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
            $filePath = $file->store('kelompok_tani', 'public');

            // Baca konten file asli
            $fileContent = file_get_contents($file->getRealPath());

            Storage::disk('public')->put($filePath, $fileContent);

            // Simpan nama file baru untuk database
            $fotoKelompokName = $filePath;
        }

        $request = [
            'nama_kelompok' => $dataRequest['nama_kelompok'],
            'status_kelompok' => $dataRequest['status_kelompok'],
            'alamat_kelompok' => $dataRequest['alamat_kelompok'],
            'ketua_kelompok' => $dataRequest['ketua_kelompok'],
            'alamat_ketua' => $dataRequest['alamat_ketua'],
            'hp_ketua' => $dataRequest['hp_ketua'],
            'foto_kelompok' => $fotoKelompokName,
            'jumlah_anggota' => $dataRequest['jumlah_anggota'],
            'id_kab_kota' => $dataRequest['id_kab_kota'],
            'kecamatan' => $dataRequest['kecamatan'],
            'desa' => $dataRequest['desa'],
            'luas_lahan' => $dataRequest['luas_lahan'],
            'koordinat' => $dataRequest['koordinat'],
            'user_id' => $dataRequest['user_id'],
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
