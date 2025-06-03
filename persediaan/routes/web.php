<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\LaporanController;

Route::get('/', function () {
    return view('auth.loginnew');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin full access
Route::middleware(['auth', 'Ceklevel:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('produks', ProdukController::class);
    Route::resource('produk-masuks', ProdukMasukController::class);
    Route::resource('produk-keluars', ProdukKeluarController::class);
    Route::resource('stoks', StokController::class);

    // Expired alert & handling
    Route::get('/stoks/expired', [StokController::class, 'expired'])->name('stoks.expired');
    Route::post('/stok/clear-alert', [StokController::class, 'clearAlert'])->name('stok.clear-alert');
});

// Pemilik (laporan saja)
Route::middleware(['auth', 'Ceklevel:admin,pemilik'])->group(function () {
    Route::get('/laporan/produk-masuk', [LaporanController::class, 'produkMasuk'])->name('laporan.produkmasuk');
    Route::get('/laporan/produk-masuk/cetak', [LaporanController::class, 'cetakProdukMasukPdf'])->name('laporan.produk-masuk.cetak');

    Route::get('/laporan/produk-keluar', [LaporanController::class, 'produkKeluar'])->name('laporan.produkkeluar');
    Route::get('/laporan/produk-keluar/cetak', [LaporanController::class, 'cetakProdukKeluarPdf'])->name('laporan.produk-keluar.cetak');

    Route::get('/laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
    Route::get('/laporan/stok/cetak', [LaporanController::class, 'cetakLaporanStokPdf'])->name('laporan.stok.cetak');
});

require __DIR__.'/auth.php';
