<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenilaianElemenController;

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

Route::get('/privacy-policy', function () {
    return view('privacy-policy');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/migrate', function() {
    Artisan::call('migrate');
});

Route::get('/storage', function() {
    Artisan::call('storage:link');
});

Route::get('/db-fresh', function() {
    Artisan::call('migrate:fresh');
});

Route::get('/seeder', function() {
    Artisan::call('db:seed');
});

Route::get('/excel/{id}', [PenilaianElemenController::class, 'excel']);
Route::get('/excel/akreditasi/{akreditasi}/bab/{id}', [PenilaianElemenController::class, 'bab']);
Route::get('/email-verif', function() {
    return view('emailVerif');
});

