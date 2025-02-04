<?php

namespace Database\Seeders;

use App\Models\Bhabinkamtibmas;
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
        // Bhabinkamtibmas
        User::create([
            'name' => 'bhabinkamtibmas',
            'email' => 'bhabinkamtibmas@pangantrack.com',
            'email_verified_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'password' => Hash::make('12345'),
            'level' => '1',
            'status' => '1',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
        Bhabinkamtibmas::create([
            'nama_bhabin' => 'Brigpol Bagas Askara',
            'nrp_bhabin' => '123456789',
            'jabatan_bhabin' => 'Brigpol',
            'tempat_dinas_bhabin' => 'Polres Kabupaten Pandeglang',
            'alamat_bhabin' => 'Jalan Bhayangkara No.07 Pandeglang',
            'hp_bhabin' => '08123456789',
            'user_id' => '2',
            'created_at' => Carbon::create(2024, 10, 10, 12, 0, 0), // Format: (year, month, day, hour, minute, second)
            'updated_at' => Carbon::create(2024, 10, 10, 12, 0, 0) // Format: (year, month, day, hour, minute, second)
        ]);
    }
}
