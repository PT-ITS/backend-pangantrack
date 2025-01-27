<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KelompokTaniController;
use App\Http\Controllers\PetaniController;
use App\Http\Controllers\JenisPanenController;
use App\Http\Controllers\PanenController;


Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('register-mitra-intelud', [AuthController::class, 'registerMitraIntelud']);
    Route::post('login', [AuthController::class, 'login']);
    Route::delete('delete-mitra-intelud/{id}', [AuthController::class, 'deleteMitraIntelud']);
    Route::post('document-mitra-intelud/{id}', [AuthController::class, 'uploadDocumentMitraIntelud']);
    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        // Route::get('pic-intelud', [AuthController::class, 'listPicIntelud']);
        Route::get('list-mitra-intelud', [AuthController::class, 'listMitraIntelud']);
        Route::post('verify-mitra-intelud/{id}', [AuthController::class, 'verifyMitraIntelud']);
        Route::get('detail-mitra-intelud/{id}', [AuthController::class, 'detailMitraIntelud']);
        Route::group([
            'middleware' => 'auth:api'
        ], function () {
            // api secure

        });
    });
});

Route::prefix('kelopompok-tani')->group(function () {
    Route::get('list', [KelompokTaniController::class, 'listKelompokTani']);
    Route::post('create', [KelompokTaniController::class, 'createKelompokTani']);
    Route::post('update/{id}', [KelompokTaniController::class, 'updateKelompokTani']);
    Route::delete('delete/{id}', [KelompokTaniController::class, 'deleteKelompokTani']);
});

Route::prefix('petani')->group(function () {
    Route::get('list/{id}', [PetaniController::class, 'listPetaniByKelompok']);
    Route::post('create', [PetaniController::class, 'createPetani']);
    Route::post('update/{id}', [PetaniController::class, 'updatePetani']);
    Route::delete('delete/{id}', [PetaniController::class, 'deletePetani']);
});

Route::prefix('jenis-tanaman')->group(function () {
    Route::get('list/{id}', [JenisPanenController::class, 'listJenisPanen']);
    Route::post('create', [JenisPanenController::class, 'createJenisPanen']);
    Route::post('update/{id}', [JenisPanenController::class, 'updateJenisPanen']);
    Route::delete('delete/{id}', [JenisPanenController::class, 'deleteJenisPanen']);
});

Route::prefix('panen')->group(function () {
    Route::get('list/{id}', [PanenController::class, 'listPanenByPetani']);
    Route::post('create', [PanenController::class, 'createPanen']);
    Route::post('update/{id}', [PanenController::class, 'updatePanen']);
    Route::delete('delete/{id}', [PanenController::class, 'deletePanen']);
});

Route::prefix('alsintan')->group(function () {
    Route::get('list/{id}', [PanenController::class, 'listPanenByPetani']);
    Route::post('create', [PanenController::class, 'createPanen']);
    Route::post('update/{id}', [PanenController::class, 'updatePanen']);
    Route::delete('delete/{id}', [PanenController::class, 'deletePanen']);
});

