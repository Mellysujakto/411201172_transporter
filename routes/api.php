<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/kurir/register', 'API\UserAPIController@create');
Route::post('/kurir/authentication', 'API\UserAPIController@getToken');

Route::group(['middleware' => 'auth.api'], function () {
    Route::get('/kurir', 'API\UserAPIController@list');
    Route::get('/kurir/{id}', 'API\UserAPIController@getById');
    Route::post('/kurir', 'API\UserAPIController@create');
    Route::put('/kurir', 'API\UserAPIController@update');
    Route::delete('/kurir/{id}', 'API\UserAPIController@delete');

    Route::get('/barang', 'API\BarangApiController@list');
    Route::get('/barang/{id}', 'API\BarangApiController@getById');
    Route::post('/barang', 'API\BarangApiController@create');
    Route::put('/barang', 'API\BarangApiController@update');
    Route::delete('/barang/{id}', 'API\BarangApiController@delete');

    Route::get('/lokasi', 'API\LokasiAPIController@list');
    Route::get('/lokasi/{id}', 'API\LokasiAPIController@getById');
    Route::post('/lokasi', 'API\LokasiAPIController@create');
    Route::put('/lokasi', 'API\LokasiAPIController@update');
    Route::delete('/lokasi/{id}', 'API\LokasiAPIController@delete');

    Route::post('/pengiriman', 'API\PengirimanAPIController@input');
    Route::post('/pengiriman/approve', 'API\PengirimanAPIController@approve');
    Route::get('/pengiriman/status/{id}', 'API\PengirimanAPIController@status');
    Route::get('/pengiriman/kurir/{kurirId}', 'API\PengirimanAPIController@listByKurirId');
    Route::get('/pengiriman', 'API\PengirimanAPIController@list');
    Route::get('/pengiriman/threeMonthsAgo', 'API\PengirimanAPIController@totalPengiriman3BulanTerakhir');
    Route::get('/pengiriman/lokasi/lebihDariSeratusKali/thisMonth', 'API\PengirimanAPIController@lokasiPengirimanLebihDari100BulanIni');
    Route::get('/pengiriman/barang/hargaLebihDari1000/thisYear', 'API\PengirimanAPIController@barangDenganHargaLebihDari1000TahunIni');
    Route::get('/pengiriman/lokasi/best/lastMonth', 'API\PengirimanAPIController@bestLokasiLastMonth');
});
