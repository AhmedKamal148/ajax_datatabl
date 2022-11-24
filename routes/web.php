<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Route;

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
Route::group(['prefix' => 'city', 'as' => 'cities'], function () {
    Route::get('/', [CityController::class, 'index']);
    Route::get('/get-data', [CityController::class, 'getData']);
    Route::post('/edit', [CityController::class, 'edit']);
    Route::post('/update', [CityController::class, 'update']);
    Route::post('/store', [CityController::class, 'store']);
    Route::post('/delete', [CityController::class, 'delete']);
});

Route::group(['prefix' => 'client', 'as' => 'clients'], function () {
    Route::get('/', [ClientController::class, 'index']);
    Route::get('/get-data', [ClientController::class, 'getData']);
    Route::post('/edit', [ClientController::class, 'edit']);
    Route::post('/store', [ClientController::class, 'store']);

});