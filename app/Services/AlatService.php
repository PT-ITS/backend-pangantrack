<?php

namespace App\Services;

use App\Repositories\AlatRepository;

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
         // Ambil data kelompok tani saat ini dari repository
         $alatTani = $this->jenisPanenRepository->find($id);
        
         // Proses upload foto baru jika ada
         $fotoalatTani = $alatTani->foto_alat; // Simpan nama file lama secara default
 
         if (isset($dataRequest['foto_alat']) && $dataRequest['foto_alat']->isValid()) {
             // Hapus gambar lama jika ada
             if ($alatTani->foto_alat) {
                 Storage::disk('public')->delete($alatTani->foto_alat);
             }
 
             $file = $dataRequest['foto_alat'];
 
             // Generate path penyimpanan dengan nama unik
             $filePath = $file->store('alat-tani/foto_alat', 'public');
 
             // Baca konten file asli
             $fileContent = file_get_contents($file->getRealPath());
 
             Storage::disk('public')->put($filePath, $fileContent);
 
             // Simpan nama file baru untuk database
             $fotoalatTani = $filePath;
         }
 
         $request = [
            'jenis_alat' => $dataRequest['jenis_alat'],
            'name_alat' => $dataRequest['name_alat'],
            'deskripsi_alat' => $dataRequest['deskripsi_alat'],
            'foto_alat' => $dataRequest['foto_alat'],
            'status' => $dataRequest['status'],
            'penyedia_id' => $dataRequest['penyedia_id']
           
         ];
        return $this->alatRepository->createAlat($request);
    }

}