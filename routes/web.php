<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'language'], function () {
    Route::get('/', function () {
        return view('start');
    });


    Auth::routes(['verify' => 'true']);
    Route::group(['middleware' => 'verified'], function () {

        // Rutas a verificar
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

        Route::get('/apuestas/{idPartido}', [App\Http\Controllers\ApuestaController::class, 'index'])->name('apuestas')->middleware('auth');
        Route::post('/apuestas/{idPartido}', [App\Http\Controllers\ApuestaController::class, 'store'])->middleware('auth');
        Route::get('/delete-apuseta/{user_id}/partido/{partido_id}', [App\Http\Controllers\ApuestaController::class, 'destroy'])->name('destroy-apuesta')->middleware('auth');

        Route::group(['middleware' => 'admin'], function () {

            Route::get('/management', [App\Http\Controllers\PartidoController::class, 'index'])->name('management')->middleware('auth')->middleware('admin');
            Route::get('/management/{show}', [App\Http\Controllers\PartidoController::class, 'index'])->name('managementShow')->middleware('auth');
            Route::get('/management2/{showMatch}', [App\Http\Controllers\PartidoController::class, 'index'])->name('managementShowAddMatch')->middleware('auth');
            Route::get('/management3/{showResult}/result/{partId}', [App\Http\Controllers\PartidoController::class, 'index'])->name('managementShowAddResult')->middleware('auth');
            Route::post('/management', [App\Http\Controllers\PartidoController::class, 'store'])->name('team_create')->middleware('auth');
            Route::post('/management-create', [App\Http\Controllers\PartidoController::class, 'create'])->middleware('auth');
            Route::post('/management-update/{partido}', [App\Http\Controllers\PartidoController::class, 'update'])->middleware('auth');
            Route::get('/delete-match/{partido}', [App\Http\Controllers\PartidoController::class, 'destroy'])->name('delete_match')->middleware('auth');
        });
    });
});
