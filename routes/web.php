<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HpController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SparepartController;
use App\Http\Controllers\TeknisiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AntrianController;
use App\Http\Controllers\PcAntrianController;
use App\Http\Controllers\DashboardController;

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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
  
    Route::group(['prefix' => 'cs', 'as' => 'cs.'],function(){
        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function(){            
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/get-customers', [CustomerController::class, 'getCustomers'])->name('getCustomers');
            Route::post('/store', [CustomerController::class, 'store'])->name('store');
        }); 

        Route::group(['prefix' => 'sparepart', 'as' => 'sparepart.'], function(){
            Route::get('/', [SparepartController::class, 'index'])->name('index');
            Route::get('/get-getSpareparts', [SparepartController::class, 'getSpareparts'])->name('getSpareparts');
            Route::post('/store', [SparepartController::class, 'store'])->name('store');
            Route::put('/update', [SparepartController::class, 'update'])->name('update');
            Route::post('/update-status', [SparepartController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'service', 'as' => 'service.'], function(){
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/get-services', [ServiceController::class, 'getServices'])->name('getServices');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            // Route::put('/update', [SparepartController::class, 'update'])->name('update');
            Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'teknisi', 'as' => 'teknisi.'], function(){
            Route::get('/', [TeknisiController::class, 'index'])->name('index');
            Route::get('/get-teknisis', [TeknisiController::class, 'getTechnicians'])->name('getTechnicians');
            Route::post('/store', [TeknisiController::class, 'store'])->name('store');
            Route::put('/update', [TeknisiController::class, 'update'])->name('update');
            // Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'hp', 'as' => 'hp.'], function(){
            Route::get('/', [HpController::class, 'index'])->name('index');
            Route::get('/merk-getall', [HpController::class, 'getHpMerk'])->name('getHpMerk');
            Route::get('/model-getall', [HpController::class, 'getHpModel'])->name('getHpModel');
            // Route::get('/get-teknisis', [TeknisiController::class, 'getTechnicians'])->name('getTechnicians');
            Route::post('/merk-store', [HpController::class, 'merkStore'])->name('merkStore');
            Route::post('/model-store', [HpController::class, 'modelStore'])->name('modelStore');
            // Route::put('/update', [TeknisiController::class, 'update'])->name('update');
            // Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function(){
            Route::get('/', [BookingController::class, 'index'])->name('index');
            Route::get('/get-booking', [BookingController::class, 'getBooking'])->name('getBooking');
            Route::get('/create', [BookingController::class, 'create'])->name('create');
            Route::post('/store', [BookingController::class, 'store'])->name('store');
            Route::get('/{id}', [BookingController::class, 'show'])->name('show');
            Route::post('/cust/{nohp}', [BookingController::class, 'searchCustomer'])->name('nohp');
            Route::get('/detail', [BookingController::class, 'displayDetail'])->name('displayDetail');
            // Route::put('/update', [BookingController::class, 'update'])->name('update');
            // Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'pembayaran', 'as' => 'pembayaran.'], function(){
            Route::get('/', [MetodePembayaranController::class, 'index'])->name('index');
            Route::post('/store', [MetodePembayaranController::class, 'store'])->name('store');
            // Route::post('/cust/{nohp}', [BookingController::class, 'searchCustomer'])->name('nohp');
            // Route::put('/update', [BookingController::class, 'update'])->name('update');
            // Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });

        Route::get('/antrian-ditangani', [AntrianController::class, 'index'])->name('antrian-ditangani');
        Route::get('/antrian', [PcAntrianController::class, 'index'])->name('pcAntrian');
        Route::post('/update-pc-antrian', [PcAntrianController::class, 'update'])->name('pcAntrian.update');
        Route::post('/mulai-antrian', [AntrianController::class, 'store'])->name('antrian.store');
        Route::post('/update-antrian', [AntrianController::class, 'update'])->name('antrian.update');
        Route::post('/update-antrianStatus', [AntrianController::class, 'status_update'])->name('antrianStatus.update');

               
    });
});
