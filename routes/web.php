<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KaryawanTetapController;
use App\Http\Controllers\KaryawanKontrakController;
use App\Http\Controllers\HistoriController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk halaman utama (root URL)
Route::get('/', [HomeController::class, 'index'])->name('home');

// --- Rute untuk Karyawan Tetap ---
Route::resource('karyawan-tetap', KaryawanTetapController::class)->except(['show']);
Route::delete('/karyawan-tetap/bulk-delete', [KaryawanTetapController::class, 'destroyBulk'])->name('karyawan-tetap.destroy.bulk');
Route::get('/karyawan-tetap/preview-pdf/{id?}', [KaryawanTetapController::class, 'previewPdf'])->name('karyawan-tetap.previewPdf');
Route::get('/karyawan-tetap/export-pdf/{id?}', [KaryawanTetapController::class, 'exportPdf'])->name('karyawan-tetap.exportPdf');
Route::post('/karyawan-tetap/{id}/approve-raise', [KaryawanTetapController::class, 'approveRaise'])->name('karyawan-tetap.approveRaise');
Route::post('/karyawan-tetap/cek-semua-prospek', [KaryawanTetapController::class, 'cekSemuaProspek'])->name('karyawan-tetap.cekSemuaProspek');
Route::post('/karyawan-tetap/{id}/revert', [KaryawanTetapController::class, 'revertRaise'])->name('karyawan-tetap.revert');


// --- Rute untuk Karyawan Kontrak ---
Route::resource('karyawan-kontrak', KaryawanKontrakController::class)->except(['show']);
Route::delete('/karyawan-kontrak/bulk-delete', [KaryawanKontrakController::class, 'destroyBulk'])->name('karyawan-kontrak.destroy.bulk');
Route::get('/karyawan-kontrak/preview-pdf', [KaryawanKontrakController::class, 'previewPdf'])->name('karyawan-kontrak.previewPdf');

// Route untuk download LAPORAN (dari halaman karyawankontrak)
// Mengarah ke metode 'exportPdfReport' sesuai kode controller Anda
Route::get('/karyawan-kontrak/export-report', [KaryawanKontrakController::class, 'exportPdfReport'])->name('karyawan-kontrak.exportReport');

// Route untuk download DETAIL (dari halaman edit_kontrak)
// Mengarah ke metode 'exportPdfDetail' sesuai kode controller Anda
Route::get('/karyawan-kontrak/{id}/export-detail', [KaryawanKontrakController::class, 'exportPdfDetail'])->name('karyawan-kontrak.exportDetail');

// Route untuk menampilkan halaman Skala Gaji
Route::get('/skala-gaji', [App\Http\Controllers\SkalaGajiController::class, 'showGaji'])->name('skala-gaji.index');

// --- Rute untuk Histori ---
Route::get('/histori', [HistoriController::class, 'index'])->name('histori.index');


// --- Rute Otentikasi (tetap sama) ---
Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function () {
    return redirect()->route('home');
})->name('login.submit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

