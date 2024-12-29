<?php

use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\DataProdukController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileCustomerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::prefix('customer')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('customer.home');
    Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/profile', [ProfileCustomerController::class, 'index'])->name('customer.profile');
    Route::post('/profile/update', [ProfileCustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::post('/update-password', [ProfileCustomerController::class, 'updatePassword'])->name('customer.profile.password.update');
});

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/data-produk', [DataProdukController::class, 'index'])->name('admin.data-produk');
    Route::get('/data-produk/create', [DataProdukController::class, 'create'])->name('admin.data-produk.create');
    Route::post('/data-produk/store', [DataProdukController::class, 'store'])->name('admin.data-produk.store');
    Route::get('/data-produk/edit/{slug}', [DataProdukController::class, 'edit'])->name('admin.data-produk.edit');
    Route::post('/data-produk/update/{id}', [DataProdukController::class, 'update'])->name('admin.data-produk.update');
    Route::delete('/data-produk/delete/{id}', [DataProdukController::class, 'delete'])->name('admin.data-produk.delete');

    ### DATA KATEGORI
    Route::get('/data-kategori', [DataKategoriController::class, 'index'])->name('admin.data-kategori');
    Route::post('/data-kategori/store', [DataKategoriController::class, 'store'])->name('admin.data-kategori.store');
    Route::delete('/data-kategori/delete/{id}', [DataKategoriController::class, 'delete'])->name('admin.data-kategori.delete');
    Route::put('/data-kategori/update/{id}', [DataKategoriController::class, 'update'])->name('admin.data-kategori.update');

    ### DATA RUANGAN
    Route::get('/data-ruangan', [DataRuanganController::class, 'index'])->name('admin.data-ruangan');
    Route::post('/data-ruangan/store', [DataRuanganController::class, 'store'])->name('admin.data-ruangan.store');
    Route::delete('/data-ruangan/delete/{id}', [DataKategoriController::class, 'delete'])->name('admin.data-kategori.delete');
    Route::put('/data-ruangan/update/{id}', [DataRuanganController::class, 'update'])->name('admin.data-ruangan.update');
});

Route::get('/produk/{slug}', [HomeController::class, 'singleProduk'])->name('single.produk');
Route::get('/semua-produk', [HomeController::class, 'allProduk'])->name('all.produk');


require __DIR__ . '/auth.php';
