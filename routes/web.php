<?php

use App\Http\Controllers\admin\AddServiceControler;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ClaimGaransiController;
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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SpendingController;
use App\Http\Controllers\teknisi\DashboardController as TeknisiDashboardController;
use App\Http\Controllers\teknisi\BookingController as TeknisiBookingController;
use App\Http\Controllers\teknisi\ClaimGaransiController as TeknisiClaimController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\CabangControllerr as AdminCabangController;
use App\Http\Controllers\admin\ServisController as AdminServisController;
use App\Http\Controllers\admin\RequestDiskonController;
use App\Http\Controllers\admin\SparepartController as AdminSparepartController;
use GuzzleHttp\Middleware;

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
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:super-admin'
])->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'cabang', 'as' => 'cabang.'], function () {
            Route::get('/', [AdminCabangController::class, 'index'])->name('index');
            Route::get('/list-teknisi', [AdminCabangController::class, 'listTeknisi'])->name('teknisi');
            Route::get('/get-teknisi/{id}', [AdminCabangController::class, 'getTechnicians'])->name('getTechnicians');
            Route::get('/get-cabang', [AdminCabangController::class, 'getCabang'])->name('getCabang');
            Route::post('/', [AdminCabangController::class, 'store'])->name('store');
        });
        Route::group(['prefix' => 'servis', 'as' => 'servis.'], function () {
            Route::get('/', [AdminServisController::class, 'index'])->name('index');
            Route::post('/', [AdminServisController::class, 'store'])->name('store');
            Route::put('/update', [ServiceController::class, 'update'])->name('update');
            Route::get('/get-services', [AdminServisController::class, 'getServices'])->name('getServices');
            Route::get('/add-services', [AdminServisController::class, 'create'])->name('create');
            Route::get('/test-route', function () {
                return "Route berhasil dipanggil!";
            });
        });
        Route::group(['prefix' => 'diskon', 'as' => 'diskon.'], function () {
            Route::get('/', [RequestDiskonController::class, 'index'])->name('index');
            Route::get('/get-booking-diskon', [RequestDiskonController::class, 'getDiskon'])->name('diskon.getDiskon');
            Route::get('/test-route', function () {
                return "Route berhasil dipanggil!";
            });
            Route::get('/{id}', [RequestDiskonController::class, 'show'])->name('show');
            Route::put('/{id}', [RequestDiskonController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'sparepart', 'as' => 'sparepart.'], function () {
            Route::get('/', [AdminSparepartController::class, 'index'])->name('index');
            Route::get('/get-getSpareparts', [AdminSparepartController::class, 'getSpareparts'])->name('getSpareparts');
            Route::get('/create-sparepart', [AdminSparepartController::class, 'create'])->name('create');
            Route::post('/create-sparepart', [AdminSparepartController::class, 'store'])->name('store');
            Route::get('/{id}', [AdminSparepartController::class, 'show'])->name('show');
            // Route::put('/{id}', [AdminSparepartController::class, 'update'])->name('update');
            Route::put('/update', [SparepartController::class, 'update'])->name('update');

            // Route::get('/get-booking-diskon', [AdminSparepartController::class, 'getBooking'])->name('getBooking');

        });
    });
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:teknisi'
])->group(function () {
    Route::group(['prefix' => 'teknisi', 'as' => 'teknisi.'], function () {
        Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])->name('dashboard');

        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            Route::get('/{status}', [TeknisiBookingController::class, 'index'])->name('index');
            Route::get('/{id}/detail', [TeknisiBookingController::class, 'show'])->name('show');
            Route::put('/{id}', [TeknisiBookingController::class, 'update'])->name('update');
        });
        Route::group(['prefix' => 'claim', 'as' => 'claim.'], function () {
            Route::get('/', [TeknisiClaimController::class, 'index'])->name('index');
            Route::get('/{id}', [TeknisiClaimController::class, 'show'])->name('show');
            Route::put('/{id}', [TeknisiClaimController::class, 'update'])->name('update');
        });
    });


    // Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::group([
    'prefix' => 'cs/pembayaran',
    'as' => 'cs.pembayaran.',
    'middleware' => 'role:cabang|super-admin'
], function () {
    Route::get('/', [MetodePembayaranController::class, 'index'])->name('index');
    Route::post('/store', [MetodePembayaranController::class, 'store'])->name('store');
});
Route::group([
    'prefix' => 'cs/booking',
    'as' => 'cs.booking.',
    'middleware' => 'role:cabang|super-admin'
], function () {
    Route::get('/', [BookingController::class, 'index'])->name('index');
    Route::get('/get-booking', [BookingController::class, 'getBooking'])->name('getBooking');
    Route::get('/create', [BookingController::class, 'create'])->name('create');
    Route::post('/store', [BookingController::class, 'store'])->name('store');
    Route::get('/{id}', [BookingController::class, 'show'])->name('show');
    Route::post('/cust/{nohp}', [BookingController::class, 'searchCustomer'])->name('nohp');
    Route::get('/detail/{id}', [BookingController::class, 'displayDetail'])->name('displayDetail');
});
Route::group([
    'prefix' => 'cs/claim',
    'as' => 'cs.claim.',
    'middleware' => 'role:cabang|super-admin'
], function () {
    Route::get('/', [ClaimGaransiController::class, 'index'])->name('index');
    Route::get('/create', [ClaimGaransiController::class, 'create'])->name('create');
    Route::get('/get-claims', [ClaimGaransiController::class, 'getClaims'])->name('getClaims');
    Route::get('/{id}', [ClaimGaransiController::class, 'show'])->name('show');
});
Route::group([
    'prefix' => 'cs/teknisi',
    'as' => 'cs.teknisi.',
    'middleware' => 'role:cabang|super-admin'
], function () {
    Route::get('/', [TeknisiController::class, 'index'])->name('index');
    Route::get('/get-teknisis', [TeknisiController::class, 'getTechnicians'])->name('getTechnicians');
    Route::get('/{id}', [TeknisiController::class, 'show'])->name('show');
    Route::get('booking/{id}', [TeknisiController::class, 'bookingTeknisi'])->name('bookingTeknisi');
    Route::get('getBooking/{id}', [TeknisiController::class, 'getBookingTeknisi'])->name('getBookingTeknisi');
    Route::get('claim/{id}', [TeknisiController::class, 'claimTeknisi'])->name('claimTeknisi');
    Route::get('getclaim/{id}', [TeknisiController::class, 'getClaimTeknisi'])->name('getClaimTeknisi');
});
Route::group([
    'prefix' => 'cs/hp',
    'as' => 'cs.hp.',
    'middleware' => 'role:cabang|super-admin'
], function () {
    Route::get('/', [HpController::class, 'index'])->name('index');
    Route::get('/merk-getall', [HpController::class, 'getHpMerk'])->name('getHpMerk');
    Route::get('/model-getall', [HpController::class, 'getHpModel'])->name('getHpModel');
    // Route::get('/get-teknisis', [TeknisiController::class, 'getTechnicians'])->name('getTechnicians');
    Route::post('/merk-store', [HpController::class, 'merkStore'])->name('merkStore');
    Route::put('/merk-update', [HpController::class, 'merkUpdate'])->name('merkUpdate');
    Route::post('/model-store', [HpController::class, 'modelStore'])->name('modelStore');
    Route::put('/model-update', [HpController::class, 'modelUpdate'])->name('modelUpdate');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'role:cabang'
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::group(['prefix' => 'cs', 'as' => 'cs.'], function () {
        Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::get('/get-customers', [CustomerController::class, 'getCustomers'])->name('getCustomers');
            Route::post('/store', [CustomerController::class, 'store'])->name('store');
        });

        Route::group(['prefix' => 'sparepart', 'as' => 'sparepart.'], function () {
            Route::get('/', [SparepartController::class, 'index'])->name('index');
            Route::get('/get-getSpareparts', [SparepartController::class, 'getSpareparts'])->name('getSpareparts');
            Route::post('/store', [SparepartController::class, 'store'])->name('store');
            Route::put('/update', [SparepartController::class, 'update'])->name('update');
            Route::post('/update-status', [SparepartController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'service', 'as' => 'service.'], function () {
            Route::get('/', [ServiceController::class, 'index'])->name('index');
            Route::get('/get-services', [ServiceController::class, 'getServices'])->name('getServices');
            Route::post('/store', [ServiceController::class, 'store'])->name('store');
            Route::put('/update', [ServiceController::class, 'update'])->name('update');
            Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });
        Route::group(['prefix' => 'teknisi', 'as' => 'teknisi.'], function () {

            Route::post('/store', [TeknisiController::class, 'store'])->name('store');
            Route::put('/update', [TeknisiController::class, 'update'])->name('update');
            // Route::get('/detail/{id}', [TeknisiController::class, 'displayDetail'])->name('displayDetail');
            // Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });
        // Route::group(['prefix' => 'hp', 'as' => 'hp.'], function () {
        //     Route::get('/', [HpController::class, 'index'])->name('index');
        //     Route::get('/merk-getall', [HpController::class, 'getHpMerk'])->name('getHpMerk');
        //     Route::get('/model-getall', [HpController::class, 'getHpModel'])->name('getHpModel');
        //     Route::post('/merk-store', [HpController::class, 'merkStore'])->name('merkStore');
        //     Route::post('/model-store', [HpController::class, 'modelStore'])->name('modelStore');

        // });
        Route::group(['prefix' => 'booking', 'as' => 'booking.'], function () {
            // Route::get('/', [BookingController::class, 'index'])->name('index');
            // Route::get('/get-booking', [BookingController::class, 'getBooking'])->name('getBooking');
            // Route::get('/create', [BookingController::class, 'create'])->name('create');
            // Route::post('/store', [BookingController::class, 'store'])->name('store');
            // Route::get('/{id}', [BookingController::class, 'show'])->name('show');
            // Route::post('/cust/{nohp}', [BookingController::class, 'searchCustomer'])->name('nohp');
            // Route::get('/detail/{id}', [BookingController::class, 'displayDetail'])->name('displayDetail');
            // Route::put('/update', [BookingController::class, 'update'])->name('update');
            // Route::post('/update-status', [ServiceController::class, 'updateStatus'])->name('updateStatus');
        });

        Route::group(['prefix' => 'spending', 'as' => 'spending.'], function () {
            Route::get('/', [SpendingController::class, 'index'])->name('index');
            Route::get('/create', [SpendingController::class, 'create'])->name('create');
            Route::get('/get-spendings', [SpendingController::class, 'getSpendings'])->name('getSpendings');
            Route::get('/{id}', [SpendingController::class, 'show'])->name('show');
            // Route::get('/detail/{id}', [SpendingController::class, 'displayDetail'])->name('displayDetail');
            // Route::post('/show', [SpendingController::class, 'show'])->name('show');
        });
        Route::group(['prefix' => 'claim', 'as' => 'claim.'], function () {
            // Route::get('/', [ClaimGaransiController::class, 'index'])->name('index');
            // Route::get('/create', [ClaimGaransiController::class, 'create'])->name('create');
            // Route::get('/get-claims', [ClaimGaransiController::class, 'getClaims'])->name('getClaims');
            // Route::get('/{id}', [ClaimGaransiController::class, 'show'])->name('show');
        });
        // Route::get('/', [SpendingController::class, 'index'])->name('spending');

        Route::get('/antrian-ditangani', [AntrianController::class, 'index'])->name('antrian-ditangani');
        Route::post('/rating', [PcAntrianController::class, 'rating'])->name('rating');
        Route::get('/antrian', [PcAntrianController::class, 'index'])->name('pcAntrian');
        Route::get('/info-antrian', [PcAntrianController::class, 'antrianDitangani'])->name('info-antrian');
        Route::post('/checkNota', [PcAntrianController::class, 'checkNota'])->name('checkNota');
        Route::get('/submit-review', [PcAntrianController::class, 'submitReview'])->name('submitReview');
        Route::post('/update-pc-antrian', [PcAntrianController::class, 'update'])->name('pcAntrian.update');
        Route::post('/mulai-antrian', [AntrianController::class, 'store'])->name('antrian.store');
        Route::post('/update-antrian', [AntrianController::class, 'update'])->name('antrian.update');
        Route::post('/update-antrianStatus', [AntrianController::class, 'status_update'])->name('antrianStatus.update');
        Route::get('/profile-cabang', [ProfileController::class, 'index'])->name('profile-cabang');
    });
});
