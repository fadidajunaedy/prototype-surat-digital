<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataDiriController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\VerificationController;

use App\Http\Controllers\PengajuanAdminController;
use App\Http\Controllers\KkAdminController;

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

Route::get('/admin', function () {
    return view('admin.index');
});

Route::get('/admin/pengajuan', function () {
    return view('admin.sections.pengajuan');
});

Route::get('/data-diri', function () {
    return view('client.data-diri.index');
})->middleware('can:isAuthor');

// Route::get('/pengajuan-surat', function () {
//     return view('client.pengajuan-surat.index');
// });

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
    Route::get('/data-diri', 'index')->name('data-diri')->middleware('can:isAuthor');
    Route::patch('/data-diri/update', 'update')->name('data-diri.update')->middleware('can:isAuthor');
    Route::patch('/data-diri/change-password', 'changePassword')->name('data-diri.change-password')->middleware('can:isAuthor');
});

Route::controller(PengajuanController::class)->group(function () {
    Route::get('/pengajuan', 'index')->name('pengajuan')->middleware('can:isAuthor');
    Route::post('/pengajuan/store', 'store')->name('pengajuan.store')->middleware('can:isAuthor');
});

Route::controller(VerificationController::class)->group(function () {
    Route::get('/email/verify', 'show')->name('verification.notice')->middleware('auth');
    Route::get('/email/verify/{id}/{hash}', 'verify')->name('verification.verify')->middleware(['auth','signed']);
    Route::get('/email/verify/confirm', 'confirm')->name('verification.confirm')->middleware('auth');
    Route::get('/email/verify/resend', 'resend')->name('verification.resend')->middleware(['auth','throttle']);
});

Route::controller(PengajuanAdminController::class)->group(function () {
    Route::get('/admin/pengajuan', 'index')->name('admin.pengajuan');
    Route::get('/admin/pengajuan/create', 'create')->name('admin.pengajuan.create');
    Route::post('/admin/pengajuan/store', 'store')->name('admin.pengajuan.store');
    Route::get('/admin/pengajuan/{id}/edit', 'edit')->name('admin.pengajuan.edit');
    Route::patch('/admin/pengajuan/{id}/update', 'update')->name('admin.pengajuan.update');
    Route::delete('/admin/pengajuan/{id}', 'destroy')->name('admin.pengajuan.destroy');
});

Route::controller(KkAdminController::class)->group(function () {
    Route::get('/admin/kk', 'index')->name('admin.kk');
    Route::get('/admin/kk/create', 'create')->name('admin.kk.create');
    Route::post('/admin/kk/store', 'store')->name('admin.kk.store');
    Route::get('/admin/kk/{id}/edit', 'edit')->name('admin.kk.edit');
    Route::patch('/admin/kk/{id}/update', 'update')->name('admin.kk.update');
    Route::delete('/admin/kk/{id}', 'destroy')->name('admin.kk.destroy');
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
