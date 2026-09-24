<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendanceHistoryController;
use App\Http\Controllers\LoginController;

Route::post('/absen', [AttendanceController::class, 'store'])->name('absen.store');
Route::get('/absensi', [AttendanceHistoryController::class, 'index'])->name('absensi.index');

Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::delete('/dashboard/hapus/{id}', [DashboardController::class, 'hapus'])->name('dashboard.hapus');

Route::get('/absen', [AttendanceController::class, 'showForm'])->name('absen.form');
Route::get('/karyawan', [KaryawanController::class, 'index'])->name('karyawan.index');

use App\Http\Controllers\LaporanController;

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');

use App\Http\Controllers\PengaturanController;

Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');
Route::post('/pengaturan/save', [PengaturanController::class, 'save'])->name('pengaturan.save');

# AttendanceController is already imported above, no need to import again

# Remove the duplicate usages and duplicate routes lines

