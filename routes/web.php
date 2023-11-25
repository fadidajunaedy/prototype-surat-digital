<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\VerificationController;

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
    Route::get('/masuk', 'masukPage')->name('login');
    Route::post('/masuk', 'login')->name('masuk-user');
    Route::post('/keluar', 'logout')->name('keluar-user');
});

Route::controller(DataDiriController::class)->group(function () {
    Route::get('/data-diri', 'index')->middleware('can:isAuthor');
    Route::patch('/data-diri/update', 'update')->middleware('can:isAuthor')->name('data-diri.update');
    Route::patch('/data-diri/change-password', 'changePassword')->middleware('can:isAuthor')->name('data-diri.change-password');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'show')->name('verification.notice')->middleware('auth');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware(['auth','signed']);
    Route::get('/email/verify/confirm', 'confirm')->name('verification.confirm')->middleware('auth');
    Route::get('/email/verify/resend', 'resend')->name('verification.resend')->middleware(['auth','throttle']);
});

Route::get('/test-mail', [UserController::class, 'testMail']);

// Route::get('/verification-template', function () {
//     return view('authentication.verification.index');
// });

// Route::get('/email/verify/confirm', function () {
//     return view('authentication.verification.confirm');
// });

// Route::get('/', function () {
//     return view('welcome');
// });
