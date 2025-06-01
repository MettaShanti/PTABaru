<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.loginnew');
});

 Route::get('/dashboard', function () {
     return view('dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk admin (akses penuh)
Route::middleware(['auth', 'Ceklevel:admin'])->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('suppliers', SupplierController::class);
    Route::resource('produks', ProdukController::class);
    Route::resource('produk-masuks', ProdukMasukController::class);
    Route::resource('produk-keluars', ProdukKeluarController::class);
    Route::resource('stoks', StokController::class);
    Route::get('stoks-expired', [StokController::class, 'expired'])->name('stoks.expired');
});

// Route untuk admin dan pemilik (akses ke laporan)
Route::middleware(['auth', 'Ceklevel:admin,pemilik'])->group(function () {
    Route::get('laporan/produk-masuk', [LaporanController::class, 'produkMasuk'])->name('laporan.produkmasuk');
    Route::get('/laporan/produk-masuk/cetak', [LaporanController::class, 'cetakProdukMasukPdf'])->name('laporan.produk-masuk.cetak');

    Route::get('laporan/produk-keluar', [LaporanController::class, 'produkKeluar'])->name('laporan.produkkeluar');
    Route::get('/laporan/produk-keluar/cetak', [LaporanController::class, 'cetakProdukKeluarPdf'])->name('laporan.produk-keluar.cetak');

    Route::get('laporan/stok', [LaporanController::class, 'stok'])->name('laporan.stok');
    Route::get('/laporan/stok/cetak', [LaporanController::class, 'cetakLaporanStokPdf'])->name('laporan.stok.cetak');

});

Route::post('/stok/clear-alert', [StokController::class, 'clearAlert'])->name('stok.clear-alert');

Route::post('/stok/clear-alert', function () {
    session()->forget(['stok_alert', 'notif_count']);
    return response()->json(['cleared' => true]);
})->name('stok.clear-alert');


require __DIR__.'/auth.php';
