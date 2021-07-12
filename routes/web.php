<?php

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


Route::get('/index', function () {
    return view('index');
});

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


Route::post('/create', [App\Http\Controllers\HomeController::class, 'create']);

Route::get('/show/{id}', [App\Http\Controllers\HomeController::class, 'show']);

Route::delete('/destroy/{id}', [App\Http\Controllers\HomeController::class, 'destory']);

Route::post('/store', [App\Http\Controllers\HomeController::class, 'store']);

Route::get('/futsal', [App\Http\Controllers\HomeController::class, 'futsal']);

Route::get('/badminton', [App\Http\Controllers\HomeController::class, 'badminton']);

Route::post('/scheduleA', [App\Http\Controllers\HomeController::class, 'scheduleA']);

Route::get('/admin', [App\Http\Controllers\HomeController::class, 'admin']);

// Manage Courts

// Route::get('/court', [App\Http\Controllers\CourtController::class, 'index']);

// Route::post('/court', [App\Http\Controllers\CourtController::class, 'store']);

// Route::put('/court/{id}', [App\Http\Controllers\CourtController::class, 'update']);

// Route::delete('/court/{id}', [App\Http\Controllers\CourtController::class, 'destroy']);

Route::resource('court', App\Http\Controllers\CourtController::class);
