<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataDiriController;

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
    return view('client.index');
});

Route::get('/data-diri', function () {
    return view('client.data-diri.index');
})->middleware('can:isAuthor');

Route::get('/pengajuan-surat', function () {
    return view('client.pengajuan-surat.index');
});

// Route::get('/masuk', function () {
//     return view('authentication.masuk');
// });

// Route::get('/daftar', function () {
//     return view('authentication.daftar');
// });


Route::controller(UserController::class)->group(function () {
    Route::get('/daftar', 'daftarPage');
    Route::post('/daftar', 'register')->name('daftar-user');
    Route::get('/masuk', 'masukPage');
    Route::post('/masuk', 'login')->name('masuk-user');
    Route::post('/keluar', 'logout')->name('keluar-user');
});

Route::controller(DataDiriController::class)->group(function () {
    Route::get('/data-diri', 'index')->middleware('can:isAuthor');
    Route::patch('/data-diri/update', 'update')->middleware('can:isAuthor')->name('update-data-diri');
});

// Route::get('/', function () {
//     return view('welcome');
// });
