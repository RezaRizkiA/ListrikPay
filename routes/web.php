<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PenggunaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/pelanggan/cari', [PelangganController::class, 'cari'])->name('pelanggan.cari');

Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // overview
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Data Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');

    // Penggunaan Listrik
    Route::get('/penggunaan', [PenggunaanController::class, 'index'])->name('penggunaan');

    // Tagihan
    Route::get('/tagihan', [TagihanController::class, 'index'])->name('tagihan');

    // Pembayaran
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');

    // Tarif Listrik
    Route::get('/tarif', [TarifController::class, 'index'])->name('tarif');

    // User Management (opsional untuk admin)
    Route::get('/user', [UserController::class, 'index'])->name('user');

    // Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
