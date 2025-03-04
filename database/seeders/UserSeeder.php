<?php

namespace Database\Seeders;

use App\Models\AdminDinas;
use App\Models\AdminPolda;
use App\Models\Bhabinkamtibmas;
use App\Models\Penyedia;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Admin
        User::create([
            'name' => 'admin',
            'email' => 'admin@pangantrack.com',
            'email_verified_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'password' => Hash::make('12345'),
            'level' => '0',
            'status' => '1',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        // Admin Polda
        User::create([
            'name' => 'adminpolda',
            'email' => 'adminpolda@pangantrack.com',
            'email_verified_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'password' => Hash::make('12345'),
            'level' => '1',
            'status' => '1',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        AdminPolda::create([
            'nama_admin' => 'Kabag Min Rizki Satrio',
            'nrp_admin' => '123456789',
            'jabatan_admin' => 'Kabag Min',
            'tempat_dinas_admin' => 'Polresta Serang Kota',
            'alamat_admin' => 'Jl. Ahmad Yani No.64, Cipare, Kec. Serang, Kota Serang, Banten 42117',
            'hp_admin' => '08123456789',
            'user_id' => '2',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        // Penyedia
        User::create([
            'name' => 'penyedia',
            'email' => 'penyedia@pangantrack.com',
            'email_verified_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'password' => Hash::make('12345'),
            'level' => '2',
            'status' => '1',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        Penyedia::create([
            'nama' => 'Fajar Pangestu',
            'alamat' => 'Jl. Ahmad Yani No.64, Cipare, Kec. Serang, Kota Serang, Banten 42117',
            'hp' => '08123456789',
            'wilayah' => 'Polresta Serang Kota',
            'user_id' => '3',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        // Bhabinkamtibmas
        User::create([
            'name' => 'bhabinkamtibmas',
            'email' => 'bhabinkamtibmas@pangantrack.com',
            'email_verified_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'password' => Hash::make('12345'),
            'level' => '3',
            'status' => '1',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        Bhabinkamtibmas::create([
            'nama_bhabin' => 'Brigpol Bagas Askara',
            'nrp_bhabin' => '123456789',
            'jabatan_bhabin' => 'Brigpol',
            'tempat_dinas_bhabin' => 'Polresta Serang Kota',
            'alamat_bhabin' => 'Jl. Ahmad Yani No.64, Cipare, Kec. Serang, Kota Serang, Banten 42117',
            'hp_bhabin' => '08123456789',
            'user_id' => '4',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        // Admin Dinas
        User::create([
            'name' => 'admindinas',
            'email' => 'admindinas@pangantrack.com',
            'email_verified_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'password' => Hash::make('12345'),
            'level' => '4',
            'status' => '1',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        AdminDinas::create([
            'nama_admin' => 'Kabid Dedi Cahyanto',
            'nip_admin' => '123456789',
            'jabatan_admin' => 'Kepala Bidang Ketahanan Pangan',
            'tempat_dinas_admin' => 'Dinas Pertanian dan Ketahanan Pangan Kota Serang',
            'alamat_admin' => 'Jl. Jend. Sudirman No.15, Panancangan, Kec. Serang, Kota Serang, Banten 42124',
            'hp_admin' => '08123456789',
            'user_id' => '5',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
    }
}
