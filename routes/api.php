<?php

use App\Http\Controllers\AdminDinasController;
use App\Http\Controllers\AlatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPoldaController;
use App\Http\Controllers\BantuanController;
use App\Http\Controllers\BhabinkamtibmasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelompokTaniController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\JenisPanenController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PenyediaController;
use App\Http\Controllers\SewaAlatController;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('update-profile/{id}', [AuthController::class, 'updateProfile']);
        Route::post('update-password/{id}', [AuthController::class, 'updatePassword']);
        Route::group([
            'middleware' => 'auth:api'
        ], function () {
            // api secure

        });
    });
});

Route::group([
    'prefix' => 'dashboard'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('available-years-panen', [DashboardController::class, 'listAvailableYearsPanen']);
        Route::get('available-years-bantuan', [DashboardController::class, 'listAvailableYearsBantuan']);
        Route::get('line-chart-panen-admin', [DashboardController::class, 'listLineChartPanenAdmin']);
        Route::get('line-chart-bantuan-admin', [DashboardController::class, 'listLineChartBantuanAdmin']);
        // Route::get('pie-chart-panen-admin', [DashboardController::class, 'listPieChartPanenAdmin']);
    });
});

Route::group([
    'prefix' => 'admin-polda'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail/{id}', [AdminPoldaController::class, 'detailAdminPolda']);
        Route::get('detail-by-user/{id}', [AdminPoldaController::class, 'detailAdminPoldaByUserId']);
        Route::get('list', [AdminPoldaController::class, 'listAdminPolda']);
        Route::post('create', [AdminPoldaController::class, 'createAdminPolda']);
        Route::post('update/{id}', [AdminPoldaController::class, 'updateAdminPolda']);
        Route::delete('delete/{id}', [AdminPoldaController::class, 'deleteAdminPolda']);
    });
});

Route::group([
    'prefix' => 'admin-dinas'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail/{id}', [AdminDinasController::class, 'detailAdminDinas']);
        Route::get('detail-by-user/{id}', [AdminDinasController::class, 'detailAdminDinasByUserId']);
        Route::get('list', [AdminDinasController::class, 'listAdminDinas']);
        Route::post('create', [AdminDinasController::class, 'createAdminDinas']);
        Route::post('update/{id}', [AdminDinasController::class, 'updateAdminDinas']);
        Route::delete('delete/{id}', [AdminDinasController::class, 'deleteAdminDinas']);
    });
});

Route::group([
    'prefix' => 'penyedia'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail/{id}', [PenyediaController::class, 'detailPenyedia']);
        Route::get('detail-by-user/{id}', [PenyediaController::class, 'detailPenyediaByUserId']);
        Route::get('list', [PenyediaController::class, 'listPenyedia']);
        Route::post('create', [PenyediaController::class, 'createPenyedia']);
        Route::post('update/{id}', [PenyediaController::class, 'updatePenyedia']);
        Route::delete('delete/{id}', [PenyediaController::class, 'deletePenyedia']);
    });
});

Route::group([
    'prefix' => 'bhabinkamtibmas'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail/{id}', [BhabinkamtibmasController::class, 'detailBhabinkamtibmas']);
        Route::get('detail-by-user/{id}', [BhabinkamtibmasController::class, 'detailBhabinkamtibmasByUserId']);
        Route::get('list', [BhabinkamtibmasController::class, 'listBhabinkamtibmas']);
        Route::post('create', [BhabinkamtibmasController::class, 'createBhabinkamtibmas']);
        Route::post('update/{id}', [BhabinkamtibmasController::class, 'updateBhabinkamtibmas']);
        Route::delete('delete/{id}', [BhabinkamtibmasController::class, 'deleteBhabinkamtibmas']);
    });
});

Route::group([
    'prefix' => 'kelompok-tani'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail-panen-by-kabkota/{id}', [KelompokTaniController::class, 'detailPanenByKabKota']);
        Route::get('detail-panen-by-bhabin/{id}', [KelompokTaniController::class, 'detailPanenByBhabin']);
        Route::get('detail-panen', [KelompokTaniController::class, 'detailPanen']);
        Route::get('detail-by-kabkota/{id}', [KelompokTaniController::class, 'detailKelompokTaniByKabKota']);
        Route::get('detail/{id}', [KelompokTaniController::class, 'detailKelompokTani']);
        Route::get('list', [KelompokTaniController::class, 'listKelompokTani']);
        Route::get('list-with-pagination', [KelompokTaniController::class, 'listKelompokTaniPagination']);
        Route::get('list-by-bhabinkamtibmas/{id}', [KelompokTaniController::class, 'listKelompokTaniByBhabinkamtibmas']);
        Route::get('list-by-kab-kota/{id}', [KelompokTaniController::class, 'listKelompokTaniByKabKota']);
        Route::post('create', [KelompokTaniController::class, 'createKelompokTani']);
        Route::post('update/{id}', [KelompokTaniController::class, 'updateKelompokTani']);
        Route::delete('delete/{id}', [KelompokTaniController::class, 'deleteKelompokTani']);
    });
});

Route::group([
    'prefix' => 'petani'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list/{id}', [PetaniController::class, 'listPetaniByKelompok']);
        Route::post('create', [PetaniController::class, 'createPetani']);
        Route::post('update/{id}', [PetaniController::class, 'updatePetani']);
        Route::delete('delete/{id}', [PetaniController::class, 'deletePetani']);
    });
});

Route::group([
    'prefix' => 'jenis-panen'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list', [JenisPanenController::class, 'listJenisPanen']);
        Route::post('create', [JenisPanenController::class, 'createJenisPanen']);
        Route::post('update/{id}', [JenisPanenController::class, 'updateJenisPanen']);
        Route::delete('delete/{id}', [JenisPanenController::class, 'deleteJenisPanen']);
    });
});

Route::group([
    'prefix' => 'panen'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail/{id}', [PanenController::class, 'detailPanen']);
        Route::get('list', [PanenController::class, 'listPanen']);
        Route::get('list/{id}', [PanenController::class, 'listPanenByKelompokTani']);
        Route::post('create', [PanenController::class, 'createPanen']);
        Route::post('update/{id}', [PanenController::class, 'updatePanen']);
        Route::delete('delete/{id}', [PanenController::class, 'deletePanen']);
    });
});

Route::group([
    'prefix' => 'alsintan'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list', [AlatController::class, 'listAlat']);
        Route::get('list-by-penyedia/{id}', [AlatController::class, 'listAlatByPenyedia']);
        Route::post('create', [AlatController::class, 'createAlat']);
        Route::post('update/{id}', [AlatController::class, 'updateAlat']);
        Route::delete('delete/{id}', [AlatController::class, 'deleteAlat']);
    });
});

Route::group([
    'prefix' => 'sewa-alsintan'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list/{id}', [SewaAlatController::class, 'listSewaAlatByKelompokTani']);
        Route::get('list-by-penyedia/{id}', [SewaAlatController::class, 'listSewaAlatByPenyedia']);
        Route::get('list-by-bhabinkamtibmas/{id}', [SewaAlatController::class, 'listSewaAlatByBhabinkamtibmas']);
        Route::post('create', [SewaAlatController::class, 'pengajuanSewaAlat']);
        Route::post('update/{id}', [SewaAlatController::class, 'updateSewaAlat']);
        Route::post('pengembalian/{id}', [SewaAlatController::class, 'pengajuanPengembalianSewaAlat']);
        Route::post('status/{id}', [SewaAlatController::class, 'aksiPengajuanSewaAlat']);
        Route::delete('delete/{id}', [SewaAlatController::class, 'deleteSewaAlat']);
    });
});

Route::group([
    'prefix' => 'bantuan'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('detail/{id}', [BantuanController::class, 'detailBantuan']);
        Route::get('list', [BantuanController::class, 'listBantuan']);
        Route::get('list-by-bhabinkamtibmas/{id}', [BantuanController::class, 'listBantuanByBhabinkamtibmas']);
        Route::get('list-by-kelompok-tani/{id}', [BantuanController::class, 'listBantuanByKelompokTani']);
        Route::post('create', [BantuanController::class, 'createBantuan']);
        Route::post('update/{id}', [BantuanController::class, 'updateBantuan']);
        Route::delete('delete/{id}', [BantuanController::class, 'deleteBantuan']);
    });
});
