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

Route::post('/kurir/register', 'API\UserController@create');
Route::post('/kurir/authentication', 'API\UserController@getToken');

Route::group(['middleware' => 'auth.api'], function () {
    Route::get('/kurir', 'API\UserController@list');
    Route::get('/kurir/{id}', 'API\UserController@getById');
    Route::post('/kurir', 'API\UserController@create');
    Route::put('/kurir', 'API\UserController@update');
    Route::delete('/kurir/{id}', 'API\UserController@delete');

    Route::get('/barang', 'API\BarangController@list');
    Route::get('/barang/{id}', 'API\BarangController@getById');
    Route::post('/barang', 'API\BarangController@create');
    Route::put('/barang', 'API\BarangController@update');
    Route::delete('/barang/{id}', 'API\BarangController@delete');

    Route::get('/lokasi', 'API\LokasiController@list');
    Route::get('/lokasi/{id}', 'API\LokasiController@getById');
    Route::post('/lokasi', 'API\LokasiController@create');
    Route::put('/lokasi', 'API\LokasiController@update');
    Route::delete('/lokasi/{id}', 'API\LokasiController@delete');

    Route::post('/pengiriman/input', 'API\PengirimanController@input');
    Route::post('/pengiriman/approve', 'API\PengirimanController@approve');
    Route::get('/pengiriman/status/{id}', 'API\PengirimanController@status');
});
