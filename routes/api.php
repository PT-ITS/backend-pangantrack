<?php

use App\Http\Controllers\AlatController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelompokTaniController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\JenisPanenController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PenyediaController;

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
    'prefix' => 'kelompok-tani'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list', [KelompokTaniController::class, 'listKelompokTani']);
        Route::get('list-by-bhabinkamtibmas/{id}', [KelompokTaniController::class, 'listKelompokTaniByBhabinkamtibmas']);
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
        Route::get('list/{id}', [PanenController::class, 'listPanenByPetani']);
        Route::post('create', [PanenController::class, 'createPanen']);
        Route::post('update/{id}', [PanenController::class, 'updatePanen']);
        Route::delete('delete/{id}', [PanenController::class, 'deletePanen']);
    });
});

Route::group([
    'prefix' => 'penyedia'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list', [PenyediaController::class, 'listPenyedia']);
        Route::post('create', [PenyediaController::class, 'createPenyedia']);
        Route::post('update/{id}', [PenyediaController::class, 'updatePenyedia']);
        Route::delete('delete/{id}', [PenyediaController::class, 'deletePenyedia']);
    });
});

Route::group([
    'prefix' => 'alsintan'
], function () {
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('list', [AlatController::class, 'listAlat']);
        Route::post('create', [AlatController::class, 'createAlat']);
        Route::post('update/{id}', [AlatController::class, 'updateAlat']);
        Route::delete('delete/{id}', [AlatController::class, 'deleteAlat']);
    });
});
