<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PengaturanController;

Route::get('/', function () {
    return redirect()->route('siswas.index');
});

Route::resource('siswas', SiswaController::class);

// Laporan Routes
Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');

// Pengaturan Routes
Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
Route::post('/pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
