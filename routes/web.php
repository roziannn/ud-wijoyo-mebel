<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DashboardAdminController;
use App\Http\Controllers\DashboardCustomerController;
use App\Http\Controllers\DashboardKurirController;
use App\Http\Controllers\DataKategoriController;
use App\Http\Controllers\DataProdukController;
use App\Http\Controllers\DataRuanganController;
use App\Http\Controllers\DataTransaksiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileCustomerController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::prefix('customer')->middleware(['auth', 'role:customer'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('customer.home');
    Route::get('/dashboard', [DashboardCustomerController::class, 'index'])->name('customer.dashboard');
    Route::get('/profile', [ProfileCustomerController::class, 'index'])->name('customer.profile');
    Route::post('/profile/update', [ProfileCustomerController::class, 'updateProfile'])->name('customer.profile.update');
    Route::post('/update-password', [ProfileCustomerController::class, 'updatePassword'])->name('customer.profile.password.update');
    ### DATA CART
    Route::get('/keranjang', [CartController::class, 'index'])->name('customer.cart');
    Route::post('/keranjang/add', [CartController::class, 'addCart'])->name('customer.cart.add');
    Route::delete('/keranjang/delete/{id}', [CartController::class, 'delete'])->name('customer.cart.delete');
    Route::post('/keranjang/updateQty', [CartController::class, 'updateQty'])->name('customer.cart.updateQty');

    Route::get('/checkout', [CheckoutController::class, 'index'])->name('customer.checkout');
    Route::post('/checkout/store', [CheckoutController::class, 'store'])->name('customer.checkout.store');

    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('customer.transaksi');
    Route::get('/transaksi/{id}', [TransaksiController::class, 'show'])->name('customer.transaksi.show');
    Route::post('/transaksi/{id}/upload', [TransaksiController::class, 'store'])->name('customer.transaksi.store');
});

Route::prefix('kurir')->middleware(['auth', 'role:kurir'])->group(function () {
    Route::get('/dashboard', [DashboardKurirController::class, 'index'])->name('kurir.dashboard');
    Route::get('/barang-perlu-dikirim', [DashboardKurirController::class, 'perluDikirim'])->name('kurir.perluDikirim');
    Route::get('/kirim-barang/{id}', [DashboardKurirController::class, 'kirimBarang'])->name('kurir.kirimBarang');
    Route::get('/selesaikan-pengiriman/{id}', [DashboardKurirController::class, 'selesaikanPengiriman'])->name('kurir.selesaikanPengiriman');

    Route::get('/riwayat-pengiriman', [DashboardKurirController::class, 'riwayat'])->name('kurir.riwayat');
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

    ### DATA TRANSAKSI
    Route::get('/transaksi-customer', [DataTransaksiController::class, 'index'])->name('admin.transaksi-customer');
    Route::get('/transaksi-customer/{kode}', [DataTransaksiController::class, 'show'])->name('admin.transaksi-customer.show');
    Route::post('/transaksi-customer/approve/{id}', [DataTransaksiController::class, 'approve'])->name('admin.transaksi-customer.approve');
});

Route::get('/produk/{slug}', [HomeController::class, 'singleProduk'])->name('single.produk');
Route::get('/semua-produk', [HomeController::class, 'allProduk'])->name('all.produk');
Route::get('/tentang-kami', [PageController::class, 'aboutUs'])->name('about.us');


require __DIR__ . '/auth.php';
