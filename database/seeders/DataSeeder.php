<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Bantuan;
use App\Models\BantuanKelompokTani;
use App\Models\JenisPanen;
use App\Models\KelompokTani;
use App\Models\Panen;
use App\Models\Penyedia;
use App\Models\Petani;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Jenis Panen
        $jenisPanenList = [
            'Cabai',
            'Jagung',
        ];

        foreach ($jenisPanenList as $jenis) {
            JenisPanen::create([
                'jenis_panen' => $jenis,
                'foto_jenis' => '',
            ]);
        }
    }
}
