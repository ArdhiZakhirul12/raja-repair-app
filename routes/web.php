<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PcAntrianController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('pages.dashboard.dashboard');
    })->name('dashboard');
    Route::group(['prefix' => 'cs', 'as' => 'cs.'],function(){
        Route::get('/antrian-ditangani', [AntrianController::class, 'index'])->name('antrian-ditangani');
        Route::get('/antrian', [PcAntrianController::class, 'index'])->name('pcAntrian');
        Route::post('/update-pc-antrian', [PcAntrianController::class, 'update'])->name('pcAntrian.update');
        Route::post('/mulai-antrian', [AntrianController::class, 'store'])->name('antrian.store');
        Route::post('/update-antrian', [AntrianController::class, 'update'])->name('antrian.update');
        Route::post('/update-antrianStatus', [AntrianController::class, 'status_update'])->name('antrianStatus.update');
        
    });
});
