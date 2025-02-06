<?php

namespace App\Repositories;

use App\Models\AdminPolda;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminPoldaRepository
{
    private $adminPoldaModel;

    public function __construct(AdminPolda $adminPoldaModel)
    {
        $this->adminPoldaModel = $adminPoldaModel;
    }

    public function detailAdminPolda($id)
    {
        try {
            $data = $this->adminPoldaModel
                ->join('users', 'admin_poldas.user_id', '=', 'users.id')
                ->select('admin_poldas.*', 'users.image', 'users.name', 'users.email')
                ->where('admin_poldas.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data admin polda'
            ];
        }
    }

    public function detailAdminPoldaByUserId($id)
    {
        try {
            $data = $this->adminPoldaModel
                ->join('users', 'admin_poldas.user_id', '=', 'users.id')
                ->select('admin_poldas.*', 'users.image', 'users.name', 'users.email')
                ->where('users.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data admin polda'
            ];
        }
    }

    public function listAdminPolda()
    {
        try {
            $data = $this->adminPoldaModel
                ->join('users', 'admin_poldas.user_id', '=', 'users.id')
                ->select('admin_poldas.*', 'users.image', 'users.name', 'users.email')
                ->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data admin polda'
            ];
        }
    }

    public function createAdminPolda($data)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->level = '3';
            $user->status = '1';
            $user->password = bcrypt($data['password']);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            $adminPolda = new AdminPolda();
            $adminPolda->nama_admin = $data['nama_admin'];
            $adminPolda->nrp_admin = $data['nrp_admin'];
            $adminPolda->jabatan_admin = $data['jabatan_admin'];
            $adminPolda->tempat_dinas_admin = $data['tempat_dinas_admin'];
            $adminPolda->alamat_admin = $data['alamat_admin'];
            $adminPolda->hp_admin = $data['hp_admin'];
            $adminPolda->user_id = $user->id;
            $adminPolda->save();

            DB::commit();
            return [
                "id" => '1',
                'data' => $adminPolda
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data admin polda'
            ];
        }
    }

    public function updateAdminPolda($data, $id)
    {
        DB::beginTransaction();
        try {
            $adminPolda = $this->adminPoldaModel->find($id);

            $user = User::find($adminPolda->user_id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            $adminPolda->nama_admin = $data['nama_admin'];
            $adminPolda->nrp_admin = $data['nrp_admin'];
            $adminPolda->jabatan_admin = $data['jabatan_admin'];
            $adminPolda->tempat_dinas_admin = $data['tempat_dinas_admin'];
            $adminPolda->alamat_admin = $data['alamat_admin'];
            $adminPolda->hp_admin = $data['hp_admin'];
            $adminPolda->save();

            DB::commit();
            return [
                "id" => '1',
                "data" => 'update data admin polda success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "id" => '0',
                "data" => $e->getMessage()
            ];
        }
    }

    public function deleteAdminPolda($id)
    {
        try {
            $adminPolda = $this->adminPoldaModel->find($id);
            if ($adminPolda) {
                // Delete user
                User::where('id', $adminPolda->user_id)->delete();
                $adminPolda->delete();
                return [
                    "id" => '1',
                    "data" => 'delete data admin polda success'
                ];
            } else {
                return [
                    "id" => '0',
                    "data" => 'data admin polda tidak ditemukan'
                ];
            }
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "data" => 'terjadi kesalahan dalam menghapus data admin polda'
            ];
        }
    }
}
