<?php

use App\Http\Controllers\SensorController;
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

Route::get('/', [SensorController::class, 'index']);
Route::get('/store', [SensorController::class, 'store']);
Route::get('/{id}/edit', [SensorController::class, 'edit']);
Route::post('/{id}', [SensorController::class, 'update']);
Route::delete('/{id}/delete', [SensorController::class, 'destroy']);
