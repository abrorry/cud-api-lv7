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

Route::get('barang', 'BarangController@index');
Route::post('barang/simpanData', 'BarangController@simpanData');
Route::put('barang/rubahData/{id}', 'BarangController@rubahData');
Route::delete('barang/hapusData/{id}', 'BarangController@hapusData');

Route::put('barang/beli/{id}', 'BarangController@beli');
