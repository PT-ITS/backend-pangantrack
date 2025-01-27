<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\BarcodeController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/userRegistration', function () {
    return view('userRegistration');
});
Route::post('/userRegistration', function () {
    $name = request('name');
    event(new \App\Events\UserRegistration($name));
});