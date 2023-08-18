<?php

use App\Http\Controllers\AkreditasiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PuskesmasController;
use App\Http\Controllers\BabController;
use App\Http\Controllers\ElemenController;
use App\Http\Controllers\PenilaianElemenController;
use App\Models\PenilaianElemen;
use App\Models\Puskesmas;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::prefix('puskesmas')->group(function () {
    Route::controller(PuskesmasController::class)->group(
        function () {
            Route::get('/', 'index');
        }
    );
});

Route::controller(BabController::class)->group( function () {
        Route::get('akreditasi/{id}/bab', 'index'); //get bab
});

Route::controller(ElemenController::class)->group(
    function() {
        Route::get('akreditasi/{akreditasi_id}/bab/{bab_id}/standar', 'getstandar'); // get standar
        Route::get('akreditasi/{akreditasi_id}/bab/{bab_id}/standar/{standar}/kriteria', 'getKriteria'); // get kriteria
        Route::get('akreditasi/{akreditasi_id}/bab/{bab_id}/standar/{standar}/kriteria/{kriteria}/nomor', 'getNomor'); // get nomor urut
        Route::get('akreditasi/{akreditasi_id}/bab/{bab_id}/standar/{standar}/kriteria/{kriteria}/nomor/{nomor}/elemen', 'getElemen'); // get nomor urut
    }
);
Route::prefix('akreditasi')->group(function () {
    Route::controller(AkreditasiController::class)->group(
        function () {
            Route::post('/', 'create');
            Route::put('/nilai-akhir', 'updateNilaiAkhir');
            Route::get('/{id}', 'show');
        }
    );
});

Route::prefix('penilaian')->group(function () {
    Route::controller(PenilaianElemenController::class)->group(
        function () {
            Route::post('/', 'create');
            Route::get('/{id}', 'show');
        }
    );
});




