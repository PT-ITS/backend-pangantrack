<?php

namespace App\Repositories;

use App\Models\Penyedia;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PenyediaRepository
{
    private $penyediaModel;

    public function __construct(Penyedia $penyediaModel)
    {
        $this->penyediaModel = $penyediaModel;
    }

    public function detailPenyedia($id)
    {
        try {
            $data = $this->penyediaModel
                ->join('users', 'penyedias.user_id', '=', 'users.id')
                ->select('penyedias.*', 'users.image', 'users.name', 'users.email')
                ->where('penyedias.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data penyedia'
            ];
        }
    }

    public function detailPenyediaByUserId($id)
    {
        try {
            $data = $this->penyediaModel
                ->join('users', 'penyedias.user_id', '=', 'users.id')
                ->select('penyedias.*', 'users.image', 'users.name', 'users.email')
                ->where('users.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data penyedia'
            ];
        }
    }

    public function listPenyedia()
    {
        try {
            $data = $this->penyediaModel
                ->join('users', 'penyedias.user_id', '=', 'users.id')
                ->select('penyedias.*', 'users.image', 'users.name', 'users.email')
                ->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data penyedia'
            ];
        }
    }

    public function createPenyedia($data)
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

            $penyedia = new Penyedia();
            $penyedia->nama = $data['nama'];
            $penyedia->alamat = $data['alamat'];
            $penyedia->hp = $data['hp'];
            $penyedia->wilayah = $data['wilayah'];
            $penyedia->user_id = $user->id;
            $penyedia->save();

            DB::commit();
            return [
                "id" => '1',
                'data' => $penyedia
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data penyedia'
            ];
        }
    }

    public function updatePenyedia($data, $id)
    {
        DB::beginTransaction();
        try {
            $penyedia = $this->penyediaModel->find($id);

            $user = User::find($penyedia->user_id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            $penyedia->nama = $data['nama'];
            $penyedia->alamat = $data['alamat'];
            $penyedia->hp = $data['hp'];
            $penyedia->wilayah = $data['wilayah'];
            $penyedia->save();

            DB::commit();
            return [
                "id" => '1',
                "data" => 'update data penyedia success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "id" => '0',
                "data" => $e->getMessage()
            ];
        }
    }

    public function deletePenyedia($id)
    {
        try {
            $penyedia = $this->penyediaModel->find($id);
            if ($penyedia) {
                // Delete user
                User::where('id', $penyedia->user_id)->delete();
                $penyedia->delete();
                return [
                    "id" => '1',
                    "data" => 'delete data penyedia success'
                ];
            } else {
                return [
                    "id" => '0',
                    "data" => 'data penyedia tidak ditemukan'
                ];
            }
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "data" => 'terjadi kesalahan dalam menghapus data penyedia'
            ];
        }
    }
}
