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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/kurir', 'API\KurirController@list');
Route::get('/kurir/{id}', 'API\KurirController@getById');
Route::post('/kurir', 'API\KurirController@create');
Route::put('/kurir', 'API\KurirController@update');
Route::delete('/kurir/{id}', 'API\KurirController@delete');

Route::get('/barang', 'API\BarangController@list');
Route::get('/barang/{id}', 'API\BarangController@getById');
Route::post('/barang', 'API\BarangController@create');
Route::put('/barang', 'API\BarangController@update');
Route::delete('/barang/{id}', 'API\BarangController@delete');
