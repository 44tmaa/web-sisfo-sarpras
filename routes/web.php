<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengembalianController;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengembalian;

// Halaman dashboard admin (jika pakai tampilan blade)

//================
// Admin Login
//================

// Halaman login Admin
Route::get('/', function () {
    return view('login');
})->name('get.login');

Route::post('/', [AdminController::class, 'login'])->name('login');

Route::middleware('auth:admin')->group(function () {


//================
// Dashboard
//================

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// log out Admin
Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

//user
// User routes
Route::get('/user', [UserController::class, 'index'])->name('user');
Route::get('/user/export', [UserController::class, 'export'])->name('user.export');
Route::get('/createuser', [UserController::class, 'create'])->name('createuser');
Route::post('/createuser', [UserController::class, 'store'])->name('users.store');
Route::get('/edituser/{id}', [UserController::class, 'edit'])->name('edit.user.form');
Route::put('/edituser/{id}', [UserController::class, 'update'])->name('edit.user');
Route::delete('/deleteuser/{id}', [UserController::class, 'destroy'])->name('delete.user');
Route::put('/kembalikanbarang/{id}', [PeminjamanController::class, 'kembalikanbarang'])->name('kembalikan.barang');

// Kategori routes
Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
Route::get('/kategori/export', [KategoriController::class, 'export'])->name('kategori.export');
Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori.store');
Route::get('/kategori/{kategori}', [KategoriController::class, 'show'])->name('kategori.show');
Route::get('/kategori/{kategori}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
Route::put('/kategori/{kategori}', [KategoriController::class, 'update'])->name('kategori.update');
Route::delete('/kategori/{kategori}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

// Barang routes
Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
Route::get('/barang/export', [BarangController::class, 'export'])->name('barang.export');
Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
Route::delete('/barang/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');

// Peminjaman routes
Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');
Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])->name('peminjaman.show');
Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');
Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');
Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
Route::get('/peminjaman/{id}/ditolak', [PeminjamanController::class, 'formtolak'])->name('peminjaman.ditolak');
Route::put('/peminjaman/{id}/tolak', [PeminjamanController::class, 'tolakpeminjaman'])->name('peminjaman.tolak');

// Pengembalian routes
Route::get('/pengembalian', [PengembalianController::class, 'index'])->name('pengembalian.index');
Route::get('/pengembalian/export', [PengembalianController::class, 'export'])->name('pengembalian.export');
Route::get('/pengembalian/create', [PengembalianController::class, 'create'])->name('pengembalian.create');
Route::post('/pengembalian', [PengembalianController::class, 'store'])->name('pengembalian.store');
Route::get('/pengembalian/{id}', [PengembalianController::class, 'show'])->name('pengembalian.show');
Route::get('/pengembalian/{id}/edit', [PengembalianController::class, 'edit'])->name('pengembalian.edit');
Route::put('/pengembalian/{id}', [PengembalianController::class, 'update'])->name('pengembalian.update');
Route::delete('/pengembalian/{id}', [PengembalianController::class, 'destroy'])->name('pengembalian.destroy');


});