<?php

namespace App\Repositories;

use App\Models\Bantuan;
use App\Models\KelompokTani;
use App\Models\BantuanKelompokTani;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BantuanRepository
{
    private $bantuanModel;

    public function __construct(Bantuan $bantuanModel)
    {
        $this->bantuanModel = $bantuanModel;
    }

    public function detailBantuan($id)
    {
        try {
            $data = $this->bantuanModel
                ->with('kelompokTani')
                ->find($id);
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data bantuan'
            ];
        }
    }

    public function listBantuan()
    {
        try {
            $data = $this->bantuanModel
                ->with('kelompokTani')
                ->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data bantuan'
            ];
        }
    }

    public function createBantuan($data)
    {
        DB::beginTransaction();
        try {
            // $luasLahanList = [];
            if (isset($data['kelompok_tani_id']) && is_array($data['kelompok_tani_id'])) {
                foreach ($data['kelompok_tani_id'] as $kelompokTaniId) {
                    $kelompokTani = KelompokTani::find($kelompokTaniId);
                    if ($kelompokTani) {
                        $cekBantuan = Bantuan::where('jenis_bantuan', $data['jenis_bantuan'])
                            ->where('tahun', $data['tahun'])
                            ->where('bulan', $data['bulan'])
                            ->where('jumlah_bantuan', $kelompokTani->luas_lahan * 15)->first();
                        if ($cekBantuan) {
                            $bantuan = $cekBantuan;
                        }else{
                            $bantuan = new Bantuan();
                            $bantuan->id_kab_kota = $data['id_kab_kota'];
                            $bantuan->jenis_bantuan = $data['jenis_bantuan'];
                            $bantuan->jumlah_bantuan = $kelompokTani->luas_lahan * 15; //sementara
                            $bantuan->satuan_bantuan = $data['satuan_bantuan'];
                            $bantuan->bulan = $data['bulan'];
                            $bantuan->tahun = $data['tahun'];
                            // $bantuan->keterangan = $data['keterangan'];
                            $bantuan->user_id = $data['user_id'];
                            $bantuan->save();       
                        }            
                        BantuanKelompokTani::create([
                            'bantuan_id' => $bantuan->id,
                            'kelompok_tani_id' => $kelompokTaniId,
                        ]);
                        
            
                    }
                }
                DB::commit();
                return [
                    'id' => '1',
                    'data' => [
                        'id' => $bantuan->id
                    ]
                ];
            }
            
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'id' => '0',
                'data' => $e->getMessage()
            ];
        }
    }

    public function updateBantuan($data, $id)
    {
        DB::beginTransaction();
        try {
            $bantuan = $this->bantuanModel->find($id);
            $bantuan->id_kab_kota = $data['id_kab_kota'];
            $bantuan->jenis_bantuan = $data['jenis_bantuan'];
            $bantuan->jumlah_bantuan = $data['jumlah_bantuan'];
            $bantuan->satuan_bantuan = $data['satuan_bantuan'];
            $bantuan->bulan = $data['bulan'];
            $bantuan->tahun = $data['tahun'];
            // $bantuan->keterangan = $data['keterangan'];
            $bantuan->save();

            if (isset($data['kelompok_tani_id']) && is_array($data['kelompok_tani_id'])) {
                BantuanKelompokTani::where('bantuan_id', $id)->delete();
                foreach ($data['kelompok_tani_id'] as $kelompokTaniId) {
                    BantuanKelompokTani::create([
                        'bantuan_id' => $id,
                        'kelompok_tani_id' => $kelompokTaniId,
                    ]);
                }
            }

            DB::commit();
            return [
                "id" => '1',
                "data" => 'update data bantuan success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "id" => '0',
                "data" => $e->getMessage()
            ];
        }
    }

    public function deleteBantuan($id)
    {
        try {
            $bantuan = $this->bantuanModel->find($id);
            if ($bantuan) {
                $bantuan->delete();
                return [
                    "id" => '1',
                    "data" => 'delete data bantuan success'
                ];
            } else {
                return [
                    "id" => '0',
                    "data" => 'data bantuan tidak ditemukan'
                ];
            }
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "data" => 'terjadi kesalahan dalam menghapus data bantuan'
            ];
        }
    }
}
