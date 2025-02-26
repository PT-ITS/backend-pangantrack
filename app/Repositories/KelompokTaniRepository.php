<?php

namespace App\Repositories;

use App\Models\JenisPanen;
use App\Models\KelompokTani;
use App\Models\Panen;
use App\Models\Petani;

class KelompokTaniRepository
{
    public function find($id)
    {
        return KelompokTani::find($id);
    }

    public function detailPanenByKabKota($id)
    {
        try {
            // Fetch all kelompok_tani IDs under the given id_kab_kota
            $kelompokTaniIds = KelompokTani::where('id_kab_kota', $id)->pluck('id');

            if ($kelompokTaniIds->isEmpty()) {
                return [
                    'id' => '0',
                    'data' => 'Kelompok Tani tidak ditemukan'
                ];
            }

            // Get daftar_jenis_panen with total jumlah_panen across all kelompok_tani in id_kab_kota
            $daftarJenisPanen = JenisPanen::whereIn(
                'id',
                Panen::whereIn('kelompok_tani_id', $kelompokTaniIds)->pluck('jenis_panen_id')
            )
                ->withSum(['panens' => function ($query) use ($kelompokTaniIds) {
                    $query->whereIn('kelompok_tani_id', $kelompokTaniIds);
                }], 'jumlah_panen')
                ->get();

            return [
                'id' => '1',
                'data' =>  $daftarJenisPanen,
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage(),
            ];
        }
    }

    public function detailPanenByBhabin($id)
    {
        try {
            // Get all unique id_kab_kota where user_id matches $id
            $kabKotaIds = KelompokTani::where('user_id', $id)->distinct()->pluck('id_kab_kota');

            if ($kabKotaIds->isEmpty()) {
                return [
                    'id' => '0',
                    'data' => 'Data tidak ditemukan'
                ];
            }

            $result = [];

            foreach ($kabKotaIds as $id_kab_kota) {
                // Get all Kelompok Tani within this id_kab_kota
                $kelompokTaniList = KelompokTani::where('id_kab_kota', $id_kab_kota)
                    ->with(['panens' => function ($query) {
                        $query->selectRaw('kelompok_tani_id, jenis_panen_id, SUM(jumlah_panen) as total_panen')
                            ->groupBy('kelompok_tani_id', 'jenis_panen_id')
                            ->with('jenisPanen'); // Eager load jenis panen
                    }])->get();

                // Format the response for each kelompok tani
                $kelompokTaniData = $kelompokTaniList->map(function ($kelompok) {
                    return [
                        'id_kelompok_tani' => $kelompok->id,
                        'nama_kelompok' => $kelompok->nama_kelompok,
                        'cumulative_panen' => $kelompok->panens->map(function ($panen) {
                            return [
                                'jenis_panen_id' => $panen->jenis_panen_id,
                                'jenis_panen_nama' => $panen->jenisPanen->jenis_panen ?? 'Unknown',
                                'total_panen' => $panen->total_panen ?? 0
                            ];
                        })
                    ];
                });

                $result[] = [
                    'id_kab_kota' => $id_kab_kota,
                    'kelompok_tani_list' => $kelompokTaniData
                ];
            }

            return [
                'id' => '1',
                'data' => $result
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage()
            ];
        }
    }

    public function detailPanen()
    {
        try {
            // Get all unique id_kab_kota
            $kabKotaIds = KelompokTani::distinct()->pluck('id_kab_kota');

            if ($kabKotaIds->isEmpty()) {
                return [
                    'id' => '0',
                    'data' => 'Data tidak ditemukan'
                ];
            }

            $result = [];

            foreach ($kabKotaIds as $id_kab_kota) {
                // Get all Kelompok Tani within this id_kab_kota
                $kelompokTaniList = KelompokTani::where('id_kab_kota', $id_kab_kota)
                    ->with(['panens' => function ($query) {
                        $query->selectRaw('kelompok_tani_id, jenis_panen_id, SUM(jumlah_panen) as total_panen')
                            ->groupBy('kelompok_tani_id', 'jenis_panen_id')
                            ->with('jenisPanen'); // Eager load jenis panen
                    }])->get();

                // Format the response for each kelompok tani
                $kelompokTaniData = $kelompokTaniList->map(function ($kelompok) {
                    return [
                        'id_kelompok_tani' => $kelompok->id,
                        'nama_kelompok' => $kelompok->nama_kelompok,
                        'cumulative_panen' => $kelompok->panens->map(function ($panen) {
                            return [
                                'jenis_panen_id' => $panen->jenis_panen_id,
                                'jenis_panen_nama' => $panen->jenisPanen->jenis_panen ?? 'Unknown',
                                'total_panen' => $panen->total_panen ?? 0
                            ];
                        })
                    ];
                });

                $result[] = [
                    'id_kab_kota' => $id_kab_kota,
                    'kelompok_tani_list' => $kelompokTaniData
                ];
            }

            return [
                'id' => '1',
                'data' => $result
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage()
            ];
        }
    }

    public function detailKelompokTaniByKabKota($id)
    {
        try {
            // Fetch KelompokTani details based on id_kab_kota
            $kelompokTaniList = KelompokTani::where('id_kab_kota', $id)->get();

            if ($kelompokTaniList->isEmpty()) {
                return [
                    'id' => '0',
                    'data' => 'Kelompok Tani tidak ditemukan'
                ];
            }

            $result = [];

            foreach ($kelompokTaniList as $kelompok) {
                $kelompokId = $kelompok->id;

                // Get all petani IDs under this kelompok_tani
                $idPetani = Petani::where('kelompok_id', $kelompokId)->pluck('id')->toArray();

                // Count jumlah_petani
                $jumlahPetani = count($idPetani);

                // Count jumlah_jenis_panen (unique count of jenis_panen_id in Panen)
                $jumlahJenisPanen = Panen::where('kelompok_tani_id', $kelompokId)
                    ->distinct('jenis_panen_id')
                    ->count('jenis_panen_id');

                // Get daftar_jenis_panen based on jenis_panen_id from Panen
                $daftarJenisPanen = JenisPanen::whereIn(
                    'id',
                    Panen::where('kelompok_tani_id', $kelompokId)->pluck('jenis_panen_id')
                )
                    ->withSum(['panens' => function ($query) use ($kelompokId) {
                        $query->where('kelompok_tani_id', $kelompokId);
                    }], 'jumlah_panen')
                    ->get();

                // Sum jumlah_panen from Panen
                $jumlahPanen = Panen::where('kelompok_tani_id', $kelompokId)->sum('jumlah_panen');

                // Add data to result array
                $result[] = [
                    "kelompok_tani" => $kelompok,
                    "jumlah_petani" => $kelompok->jumlah_anggota,
                    "jumlah_jenis_panen" => $jumlahJenisPanen,
                    "daftar_jenis_panen" => $daftarJenisPanen,
                    "jumlah_panen" => $jumlahPanen,
                    "total_luas_lahan" => $kelompok->luas_lahan,
                ];
            }

            return [
                'id' => '1',
                'data' => $result,
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage(),
            ];
        }
    }

    public function detailKelompokTani($id)
    {
        try {
            // Fetch KelompokTani details
            $dataKelompokTani = KelompokTani::find($id);

            if (!$dataKelompokTani) {
                return [
                    'id' => '0',
                    'data' => 'Kelompok Tani tidak ditemukan'
                ];
            }

            // Get all petani IDs under the given kelompok_id
            $idPetani = Petani::where('kelompok_id', $id)->pluck('id')->toArray();

            // Count jumlah_petani
            $jumlahPetani = count($idPetani);

            // Count jumlah_jenis_panen (unique count of jenis_panen_id in Panen)
            $jumlahJenisPanen = Panen::where('kelompok_tani_id', $id)
                ->distinct('jenis_panen_id')
                ->count('jenis_panen_id');

            // Get daftar_jenis_panen based on jenis_panen_id from Panen
            $daftarJenisPanen = JenisPanen::whereIn(
                'id',
                Panen::where('kelompok_tani_id', $id)->pluck('jenis_panen_id')
            )
                ->withSum(['panens' => function ($query) use ($id) {
                    $query->where('kelompok_tani_id', $id);
                }], 'jumlah_panen')
                ->get();

            // Sum jumlah_panen from Panen
            $jumlahPanen = Panen::where('kelompok_tani_id', $id)->sum('jumlah_panen');

            return [
                'id' => '1',
                'data' => [
                    "kelompok_tani" => $dataKelompokTani,
                    "jumlah_petani" => $dataKelompokTani->jumlah_anggota,
                    "jumlah_jenis_panen" => $jumlahJenisPanen,
                    "daftar_jenis_panen" => $daftarJenisPanen,
                    "jumlah_panen" => $jumlahPanen,
                    "total_luas_lahan" => $dataKelompokTani->luas_lahan,
                ],
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage(),
            ];
        }
    }

    public function listKelompokTani()
    {
        try {
            $dataKelompokTani = KelompokTani::all();
            return [
                'id' => '1',
                'data' => $dataKelompokTani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengambil data kelompok tani'
            ];
        }
    }

    public function listKelompokTaniByBhabinkamtibmas($id)
    {
        try {
            $dataKelompokTani = KelompokTani::where('user_id', $id)->get();
            return [
                'id' => '1',
                'data' => $dataKelompokTani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengambil data kelompok tani'
            ];
        }
    }

    public function listKelompokTaniByKabKota($id)
    {
        try {
            $dataKelompokTani = KelompokTani::where('id_kab_kota', $id)->get();
            return [
                'id' => '1',
                'data' => $dataKelompokTani
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengambil data kelompok tani'
            ];
        }
    }

    public function createKelompokTani($dataRequest)
    {
        try {
            $dataKelompokTani = KelompokTani::create($dataRequest);
            return [
                'id' => '1',
                'data' => 'berhasil menambahkan data kelompok tani'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal menambahkan data kelompok tani'
            ];
        }
    }

    public function updateKelompokTani($dataRequest, $id)
    {
        try {
            $dataKelompokTani = KelompokTani::find($id);
            $dataKelompokTani->update($dataRequest);
            return [
                'id' => '1',
                'data' => 'berhasil mengubah data kelompok tani'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'gagal mengubah data kelompok tani'
            ];
        }
    }

    public function deleteKelompokTani($id)
    {
        try {
            $dataKelompokTani = KelompokTani::find($id);
            $dataKelompokTani->delete();
            return [
                'id' => '1',
                'data' => 'berhasil menghapus data kelompok tani'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data kelompok tani'
            ];
        }
    }
}
