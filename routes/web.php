<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\DashboardController;

// ==========================================
// PUBLIC ROUTES (tanpa login)
// ==========================================
Route::get('/', function () {
    return view('splash');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// PROTECTED ROUTES (harus login)
// ==========================================
Route::middleware('auth')->group(function () {

    // Dashboard - semua role bisa akses
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---- KATEGORI ----
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
        Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
        Route::get('/kategori/edit/{id}', [KategoriController::class, 'edit'])->name('kategori.edit');
        Route::post('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
        Route::delete('/kategori/delete/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    });

    // ---- BARANG ----
    Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
        Route::post('/barang/store', [BarangController::class, 'store'])->name('barang.store');
        Route::get('/barang/edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
        Route::post('/barang/update/{id}', [BarangController::class, 'update'])->name('barang.update');
        Route::delete('/barang/delete/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    });

    // ---- PEMINJAMAN ----
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman/store', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::middleware('role:admin')->group(function () {
        Route::delete('/peminjaman/delete/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');
    });
});