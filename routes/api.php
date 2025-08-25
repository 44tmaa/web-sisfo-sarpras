<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

//================
// User
//================

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Membuat Akun User

// Login User
Route::post('/login', [UserController::class, 'login']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');

// Barang
use App\Http\Controllers\Api\BarangController;
use App\Http\Controllers\Api\PeminjamanController;
use App\Http\Controllers\Api\PengembalianController;

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('barangs')->group(function () {
        Route::get('/', [BarangController::class, 'index']);
        Route::post('/', [BarangController::class, 'store']);
        Route::get('/{id}', [BarangController::class, 'show']);
        Route::put('/{id}', [BarangController::class, 'update']);
        Route::delete('/{id}', [BarangController::class, 'destroy']);
    });

    Route::prefix('peminjaman')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index']);
        Route::get('/create', [PeminjamanController::class, 'create']);
        Route::post('/', [PeminjamanController::class, 'store']);
        Route::get('/riwayat', [PeminjamanController::class, 'riwayatpeminjaman']);
        Route::get('/{id}', [PeminjamanController::class, 'show']);
        Route::put('/{id}', [PeminjamanController::class, 'update']);
        Route::post('/{id}/kembalikan', [PeminjamanController::class, 'kembalikanbarang']);
        Route::put('/{id}/tolak', [PeminjamanController::class, 'tolakpeminjaman']);
        Route::delete('/{id}', [PeminjamanController::class, 'destroy']);
    });

    Route::prefix('pengembalian')->group(function () {
        Route::get('/{id}', [PengembalianController::class, 'index']);
    });
});
