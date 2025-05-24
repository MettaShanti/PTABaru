<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukKeluarController;
use App\Http\Controllers\ProdukMasukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

 Route::get('/dashboard', function () {
     return view('dashboard');
 })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

    Route::resource('suppliers', SupplierController::class);
    Route::resource('produks', ProdukController::class);
    Route::resource('produk-masuks', ProdukMasukController::class);
    Route::resource('produk-keluars', ProdukKeluarController::class);
    Route::resource('stoks', StokController::class);
    Route::get('stoks-expired', [StokController::class, 'expired'])->name('stoks.expired');
    Route::resource('users', UserController::class);

require __DIR__.'/auth.php';
