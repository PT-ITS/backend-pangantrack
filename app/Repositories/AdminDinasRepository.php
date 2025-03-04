<?php

namespace App\Repositories;

use App\Models\AdminDinas;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDinasRepository
{
    private $adminDinasModel;

    public function __construct(AdminDinas $adminDinasModel)
    {
        $this->adminDinasModel = $adminDinasModel;
    }

    public function detailAdminDinas($id)
    {
        try {
            $data = $this->adminDinasModel
                ->join('users', 'admin_dinas.user_id', '=', 'users.id')
                ->select('admin_dinas.*', 'users.image', 'users.name', 'users.email')
                ->where('admin_dinas.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data admin dinas'
            ];
        }
    }

    public function detailAdminDinasByUserId($id)
    {
        try {
            $data = $this->adminDinasModel
                ->join('users', 'admin_dinas.user_id', '=', 'users.id')
                ->select('admin_dinas.*', 'users.image', 'users.name', 'users.email')
                ->where('users.id', $id)
                ->first();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data admin dinas'
            ];
        }
    }

    public function listAdminDinas()
    {
        try {
            $data = $this->adminDinasModel
                ->join('users', 'admin_dinas.user_id', '=', 'users.id')
                ->select('admin_dinas.*', 'users.image', 'users.name', 'users.email')
                ->get();
            return [
                'id' => '1',
                'data' => $data
            ];
        } catch (\Throwable $th) {
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam mengambil data admin dinas'
            ];
        }
    }

    public function createAdminDinas($data)
    {
        DB::beginTransaction();
        try {
            $user = new User();
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->level = '4';
            $user->status = '1';
            $user->password = bcrypt($data['password']);
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->save();

            $adminDinas = new AdminDinas();
            $adminDinas->nama_admin = $data['nama_admin'];
            $adminDinas->nip_admin = $data['nip_admin'];
            $adminDinas->jabatan_admin = $data['jabatan_admin'];
            $adminDinas->tempat_dinas_admin = $data['tempat_dinas_admin'];
            $adminDinas->alamat_admin = $data['alamat_admin'];
            $adminDinas->hp_admin = $data['hp_admin'];
            $adminDinas->user_id = $user->id;
            $adminDinas->save();

            DB::commit();
            return [
                "id" => '1',
                'data' => $adminDinas
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'id' => '0',
                'data' => 'terjadi kesalahan dalam menambahkan data admin dinas'
            ];
        }
    }

    public function updateAdminDinas($data, $id)
    {
        DB::beginTransaction();
        try {
            $adminDinas = $this->adminDinasModel->find($id);

            $user = User::find($adminDinas->user_id);
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            $adminDinas->nama_admin = $data['nama_admin'];
            $adminDinas->nip_admin = $data['nip_admin'];
            $adminDinas->jabatan_admin = $data['jabatan_admin'];
            $adminDinas->tempat_dinas_admin = $data['tempat_dinas_admin'];
            $adminDinas->alamat_admin = $data['alamat_admin'];
            $adminDinas->hp_admin = $data['hp_admin'];
            $adminDinas->save();

            DB::commit();
            return [
                "id" => '1',
                "data" => 'update data admin dinas success'
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                "id" => '0',
                "data" => $e->getMessage()
            ];
        }
    }

    public function deleteAdminDinas($id)
    {
        try {
            $adminDinas = $this->adminDinasModel->find($id);
            if ($adminDinas) {
                // Delete user
                User::where('id', $adminDinas->user_id)->delete();
                $adminDinas->delete();
                return [
                    "id" => '1',
                    "data" => 'delete data admin dinas success'
                ];
            } else {
                return [
                    "id" => '0',
                    "data" => 'data admin dinas tidak ditemukan'
                ];
            }
        } catch (\Exception $e) {
            return [
                "id" => '0',
                "data" => 'terjadi kesalahan dalam menghapus data admin dinas'
            ];
        }
    }
}
