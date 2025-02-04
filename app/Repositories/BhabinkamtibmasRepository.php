<?php

namespace App\Repositories;

use App\Models\Bhabinkamtibmas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class BhabinkamtibmasRepository
{
    private $bhabinkamtibmasModel;

    public function __construct(Bhabinkamtibmas $bhabinkamtibmasModel)
    {
        $this->bhabinkamtibmasModel = $bhabinkamtibmasModel;
    }

    public function detailBhabinkamtibmas($id)
    {
        try {
            $data = $this->bhabinkamtibmasModel
                ->join('users', 'bhabinkamtibmas.user_id', '=', 'users.id')
                ->select('bhabinkamtibmas.*', 'users.image', 'users.name', 'users.email')
                ->where('bhabinkamtibmas.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data bhabinkamtibmas'
            ];
        }
    }

    public function listBhabinkamtibmas()
    {
        try {
            $data = $this->bhabinkamtibmasModel
                ->join('users', 'bhabinkamtibmas.user_id', '=', 'users.id')
                ->select('bhabinkamtibmas.*', 'users.image', 'users.name', 'users.email')
                ->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data bhabinkamtibmas'
            ];
        }
    }

    public function createBhabinkamtibmas($data)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->level = '1';
            $user->status = '1';
            $user->password = bcrypt($data['password']);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            $bhabinkamtibmas = new Bhabinkamtibmas();
            $bhabinkamtibmas->nama_bhabin = $data['nama_bhabin'];
            $bhabinkamtibmas->nrp_bhabin = $data['nrp_bhabin'];
            $bhabinkamtibmas->jabatan_bhabin = $data['jabatan_bhabin'];
            $bhabinkamtibmas->tempat_dinas_bhabin = $data['tempat_dinas_bhabin'];
            $bhabinkamtibmas->alamat_bhabin = $data['alamat_bhabin'];
            $bhabinkamtibmas->hp_bhabin = $data['hp_bhabin'];
            $bhabinkamtibmas->user_id = $user->id;
            $bhabinkamtibmas->save();

            DB::commit();
            return [
                "id" => '1',
                'data' => $bhabinkamtibmas
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data bhabinkamtibmas'
            ];
        }
    }

    public function updateBhabinkamtibmas($data, $id)
    {
        DB::beginTransaction();
        try {
            $bhabinkamtibmas = $this->bhabinkamtibmasModel->find($id);

            $user = User::find($bhabinkamtibmas->user_id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            $bhabinkamtibmas->nama_bhabin = $data['nama_bhabin'];
            $bhabinkamtibmas->nrp_bhabin = $data['nrp_bhabin'];
            $bhabinkamtibmas->jabatan_bhabin = $data['jabatan_bhabin'];
            $bhabinkamtibmas->tempat_dinas_bhabin = $data['tempat_dinas_bhabin'];
            $bhabinkamtibmas->alamat_bhabin = $data['alamat_bhabin'];
            $bhabinkamtibmas->hp_bhabin = $data['hp_bhabin'];
            $bhabinkamtibmas->save();

            DB::commit();
            return [
                "id" => '1',
                "data" => 'update data kaintel success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "id" => '0',
                "data" => $e->getMessage()
            ];
        }
    }

    public function deleteBhabinkamtibmas($id)
    {
        try {
            $bhabinkamtibmas = $this->bhabinkamtibmasModel->find($id);
            if ($bhabinkamtibmas) {
                // Delete user
                User::where('id', $bhabinkamtibmas->user_id)->delete();
                $bhabinkamtibmas->delete();
                return [
                    "id" => '1',
                    "data" => 'delete data bhabinkamtibmas success'
                ];
            } else {
                return [
                    "id" => '0',
                    "data" => 'data bhabinkamtibmas tidak ditemukan'
                ];
            }
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "data" => 'terjadi kesalahan dalam menghapus data bhabinkamtibmas'
            ];
        }
    }
}
