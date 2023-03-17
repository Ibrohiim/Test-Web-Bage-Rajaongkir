<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CekOngkirController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/cek-ongkir',[CekOngkirController::class, 'cekOngkir']);
Route::get('/provinsi', [CekOngkirController::class, 'getProvince'])->name('provinsi');
Route::get('/kota/{id}', [CekOngkirController::class, 'getCity'])->name('kota');
Route::get('/origin={asal}&destination={tujuan}&weight={berat}&courier={kurir}',[CekOngkirController::class, 'getOngkir']);
