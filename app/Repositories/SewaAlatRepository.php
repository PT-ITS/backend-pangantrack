<?php

namespace App\Repositories;

use App\Models\Alat;
use App\Models\SewaAlat;

class SewaAlatRepository
{
    public function listSewaAlatByKelompokTani($id)
    {
        try {
            $dataSewaAlat = SewaAlat::join('kelompok_tanis as peminjam', 'sewa_alats.id_kelompok', '=', 'peminjam.id')
                ->join('alats', 'sewa_alats.id_alat', '=', 'alats.id')
                ->join('kelompok_tanis as pemilik', 'alats.pemilik_id', '=', 'pemilik.id')
                ->select(
                    'sewa_alats.*',
                    'alats.nama_alat',
                    'alats.foto_alat',
                    'alats.lokasi_awal_alat',
                    'peminjam.nama_kelompok as nama_peminjam',
                    'peminjam.alamat_kelompok as lokasi_peminjam',
                    'pemilik.nama_kelompok as nama_pemilik',
                    'pemilik.alamat_kelompok as lokasi_pemilik'
                )
                ->where('sewa_alats.id_kelompok', $id)
                ->get();
            return [
                'id' => '1',
                'data' => $dataSewaAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat'
            ];
        }
    }

    public function listSewaAlatByBhabinkamtibmas($id)
    {
        try {
            $dataSewaAlat = SewaAlat::join('kelompok_tanis as peminjam', 'sewa_alats.id_kelompok', '=', 'peminjam.id')
                ->join('alats', 'sewa_alats.id_alat', '=', 'alats.id')
                ->join('kelompok_tanis as pemilik', 'alats.pemilik_id', '=', 'pemilik.id')
                ->select(
                    'sewa_alats.*',
                    'alats.nama_alat',
                    'alats.foto_alat',
                    'alats.lokasi_awal_alat',
                    'peminjam.nama_kelompok as nama_peminjam',
                    'peminjam.alamat_kelompok as lokasi_peminjam',
                    'pemilik.nama_kelompok as nama_pemilik',
                    'pemilik.alamat_kelompok as lokasi_pemilik'
                )
                ->where('sewa_alats.id_babinsa', $id)
                ->get();
            return [
                'id' => '1',
                'data' => $dataSewaAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat'
            ];
        }
    }

    public function listSewaAlatByPenyedia($id)
    {
        try {
            $dataSewaAlat = SewaAlat::join('kelompok_tanis as peminjam', 'sewa_alats.id_kelompok', '=', 'peminjam.id')
                ->join('alats', 'sewa_alats.id_alat', '=', 'alats.id')
                ->join('kelompok_tanis as pemilik', 'alats.pemilik_id', '=', 'pemilik.id')
                ->select(
                    'sewa_alats.*',
                    'alats.nama_alat',
                    'alats.foto_alat',
                    'alats.lokasi_awal_alat',
                    'peminjam.nama_kelompok as nama_peminjam',
                    'peminjam.alamat_kelompok as lokasi_peminjam',
                    'pemilik.nama_kelompok as nama_pemilik',
                    'pemilik.alamat_kelompok as lokasi_pemilik'
                )
                ->where('alats.penyedia_id', $id)
                ->get();
            return [
                'id' => '1',
                'data' => $dataSewaAlat
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data sewa alat'
            ];
        }
    }

    public function pengajuanSewaAlat($data)
    {
        try {
            $dataSewaAlat = SewaAlat::create($data);
            return [
                'id' => '1',
                'data' => 'berhasil menambahkan data sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data sewa alat'
            ];
        }
    }

    public function pengajuanPengembalianSewaAlat($id)
    {
        try {
            $dataSewaAlat = SewaAlat::find($id);
            $dataSewaAlat->update(['status' => '3']);
            return [
                'id' => '1',
                'data' => 'berhasil mengajukan pengembalian sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengajukan pengembalian sewa alat'
            ];
        }
    }

    public function aksiPengajuanSewaAlat($data, $id)
    {
        try {
            $dataSewaAlat = SewaAlat::findOrFail($id);
            $alat = Alat::findOrFail($dataSewaAlat->id_alat);

            if ($data['status'] == '1' && $alat->jumlah_alat == 0) {
                return [
                    'id' => '0',
                    'data' => 'Gagal, alat tidak tersedia'
                ];
            }

            if ($data['status'] == '1') {
                // Reduce jumlah_alat
                $alat->jumlah_alat = max(0, $alat->jumlah_alat - $dataSewaAlat->jumlah_alat_disewa);

                // If jumlah_alat becomes 0, set status to 0 (not available)
                if ($alat->jumlah_alat == 0) {
                    $alat->status = '0';
                }

                $alat->save();
            } elseif ($data['status'] == '4') {
                // Increase jumlah_alat
                $alat->jumlah_alat += $dataSewaAlat->jumlah_alat_disewa;

                // If alat was previously not available, set status back to available (1)
                if ($alat->status == 0 && $alat->jumlah_alat > 0) {
                    $alat->status = '1';
                }

                $alat->save();
            }

            // Update status of SewaAlat
            $dataSewaAlat->update(['status' => $data['status']]);

            return [
                'id' => '1',
                'data' => 'Berhasil memproses sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'Terjadi kesalahan dalam memproses sewa alat'
            ];
        }
    }

    public function updateSewaAlat($data)
    {
        try {
            $dataSewaAlat = SewaAlat::find($data['id']);
            $dataSewaAlat->update($data);
            return [
                'id' => '1',
                'data' => 'berhasil mengubah data sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengubah data sewa alat'
            ];
        }
    }

    public function deleteSewaAlat($id)
    {
        try {
            $dataSewaAlat = SewaAlat::find($id);
            $dataSewaAlat->delete();
            return [
                'id' => '1',
                'data' => 'berhasil menghapus data sewa alat'
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menghapus data sewa alat'
            ];
        }
    }

    public function find($id)
    {
        return SewaAlat::find($id);
    }
}
