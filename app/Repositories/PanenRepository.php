<?php

namespace App\Repositories;

use App\Models\Panen;
use Carbon\Carbon;

class PanenRepository
{
    private $panenModel;

    public function __construct(Panen $panenModel)
    {
        $this->panenModel = $panenModel;
    }

    public function panenDanLahan($kabkota = null, $year = null)
    {
        try {
            $year = $year ?? Carbon::now()->year;

            $data = $this->panenModel
                ->with(['jenisPanen', 'kelompokTani'])
                ->whereHas('kelompokTani', function ($query) use ($kabkota) {
                    if ($kabkota) {
                        $query->where('id_kab_kota', $kabkota);
                    }
                })
                ->get()
                ->filter(function ($panen) use ($year) {
                    // Calculate the estimated harvest date (tanggal_panen)
                    $tanggalPanen = Carbon::parse($panen->tanggal_tanam)->addMonths(3);
                    return $tanggalPanen->year == $year;
                })
                ->groupBy('jenis_panen_id')
                ->map(function ($panens, $jenisPanenId) {
                    $jenisPanen = $panens->first()->jenisPanen;
                    $totalPerkiraanHasil = 0;
                    $totalLuasLahanDitanam = 0;

                    foreach ($panens as $panen) {
                        $kelompokTani = $panen->kelompokTani;
                        $luasLahan = $kelompokTani ? $kelompokTani->luas_lahan : 0;

                        // Sum luas lahan ditanam
                        $totalLuasLahanDitanam += $luasLahan;

                        // Calculate perkiraan hasil panen
                        $perkiraanHasil = floor($luasLahan / 10) * 6;
                        $totalPerkiraanHasil += $perkiraanHasil;
                    }

                    return [
                        'jenis_panen_id' => $jenisPanenId,
                        'jenis_panen' => $jenisPanen->jenis_panen,
                        'perkiraan_hasil_panen' => $totalPerkiraanHasil,
                        'luas_lahan_ditanam' => $totalLuasLahanDitanam
                    ];
                })
                ->values(); // Reset keys for clean JSON output

            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'Terjadi kesalahan dalam mengambil data panen'
            ];
        }
    }

    public function detailPanen($id)
    {
        try {
            $panen = $this->panenModel->with(['jenisPanen', 'kelompokTani.bantuans'])->find($id);

            if (!$panen) {
                return [
                    'id' => '0',
                    'data' => 'Data panen tidak ditemukan'
                ];
            }

            $kelompokTani = $panen->kelompokTani;

            // Check if kelompok tani has bantuan in the same bulan + tahun as tanggal_tanam
            $dapatBantuan = 'Tidak';
            if ($kelompokTani && $kelompokTani->bantuans->isNotEmpty()) {
                foreach ($kelompokTani->bantuans as $bantuan) {
                    $formattedBulan = str_pad($bantuan->bulan, 2, '0', STR_PAD_LEFT);
                    $bantuanBulanTahun = $bantuan->tahun . '-' . $formattedBulan;
                    $panenBulanTahun = date('Y-m', strtotime($panen->tanggal_tanam));
                    if ($bantuanBulanTahun === $panenBulanTahun) {
                        $dapatBantuan = 'Ya';
                        break;
                    }
                }
            }

            // Calculate perkiraan_tanggal_panen (3 months from tanggal_tanam)
            $perkiraanTanggalPanen = date('Y-m-d', strtotime('+3 months', strtotime($panen->tanggal_tanam)));

            // Calculate perkiraan_hasil
            $luasLahan = $kelompokTani ? $kelompokTani->luas_lahan : 0;
            $perkiraanHasil = $dapatBantuan === 'Ya' ? floor($luasLahan / 10) * 6 : null;

            return [
                'id' => '1',
                'data' => [
                    'id' => $panen->id,
                    'jumlah_panen' => $panen->jumlah_panen,
                    'tanggal_tanam' => $panen->tanggal_tanam,
                    'tanggal_panen' => $panen->tanggal_panen,
                    'status_panen' => $panen->status_panen,
                    'alasan' => $panen->alasan,
                    'jenis_panen' => $panen->jenisPanen,
                    'kelompok_tani' => $kelompokTani,
                    'dapat_bantuan' => $dapatBantuan,
                    'perkiraan_tanggal_panen' => $perkiraanTanggalPanen,
                    'perkiraan_hasil' => $perkiraanHasil,
                ]
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'Terjadi kesalahan dalam mengambil data panen'
            ];
        }
    }

    public function listPanen()
    {
        try {
            $data = $this->panenModel->with(['jenisPanen', 'kelompokTani.bantuans'])->get();

            $data = $data->map(function ($panen) {
                $kelompokTani = $panen->kelompokTani;

                // Check if kelompok tani has bantuan in the same bulan + tahun as tanggal_tanam
                $dapatBantuan = 'Tidak';
                if ($kelompokTani && $kelompokTani->bantuans->isNotEmpty()) {
                    foreach ($kelompokTani->bantuans as $bantuan) {
                        $formattedBulan = str_pad($bantuan->bulan, 2, '0', STR_PAD_LEFT);
                        $bantuanBulanTahun = $bantuan->tahun . '-' . $formattedBulan;
                        $panenBulanTahun = date('Y-m', strtotime($panen->tanggal_tanam));
                        if ($bantuanBulanTahun === $panenBulanTahun) {
                            $dapatBantuan = 'Ya';
                            break;
                        }
                    }
                }

                // Calculate perkiraan_tanggal_panen (3 months from tanggal_tanam)
                $perkiraanTanggalPanen = date('Y-m-d', strtotime('+3 months', strtotime($panen->tanggal_tanam)));

                // Calculate perkiraan_hasil
                $luasLahan = $kelompokTani ? $kelompokTani->luas_lahan : 0;
                $perkiraanHasil = $dapatBantuan === 'Ya' ? floor($luasLahan / 10) * 6 : null;

                return [
                    'id' => $panen->id,
                    'jumlah_panen' => $panen->jumlah_panen,
                    'tanggal_tanam' => $panen->tanggal_tanam,
                    'tanggal_panen' => $panen->tanggal_panen,
                    'status_panen' => $panen->status_panen,
                    'alasan' => $panen->alasan,
                    'jenis_panen' => $panen->jenisPanen,
                    'kelompok_tani' => $kelompokTani,
                    'dapat_bantuan' => $dapatBantuan,
                    'perkiraan_tanggal_panen' => $perkiraanTanggalPanen,
                    'perkiraan_hasil' => $perkiraanHasil,
                ];
            });

            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'Terjadi kesalahan dalam mengambil data panen'
            ];
        }
    }

    public function listPanenByKelompokTani($id)
    {
        try {
            $data = $this->panenModel->where('kelompok_tani_id', $id)->with('jenisPanen')->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data panen'
            ];
        }
    }

    public function createPanen($data)
    {
        try {
            $panen = $this->panenModel->create($data);
            return [
                'id' => '1',
                'data' => $panen
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data panen'
            ];
        }
    }

    public function updatePanen($data, $id)
    {
        try {
            $panen = $this->panenModel->where('id', $id)->update($data);
            return [
                'id' => '1',
                'data' => $panen
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => $th->getMessage()
            ];
        }
    }

    public function deletePanen($id)
    {
        try {
            $panen = $this->panenModel->where('id', $id)->delete();
            return [
                'id' => '1',
                'data' => $panen
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data panen'
            ];
        }
    }
}
