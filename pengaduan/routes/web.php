<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route untuk siswa membuat pengaduan
    Route::post('/complaint', [DashboardController::class, 'storeComplaint'])->middleware('role:siswa')->name('complaint.store');

    // Route untuk admin update pengaduan
    Route::put('/complaint/{complaint}', [DashboardController::class, 'updateComplaint'])->middleware('role:admin')->name('complaint.update');
});
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', function () {
    return view('welcome');
});
