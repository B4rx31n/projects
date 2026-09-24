<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PelangganController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// User Routes (Admin Only)
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('/user/print/data', [UserController::class, 'print'])->name('user.print');
});

// Pelanggan Routes (All Authenticated Users)
Route::middleware('auth')->group(function () {
    Route::get('/pelanggan', [PelangganController::class, 'index'])->middleware('role:user')->name('pelanggan');
    Route::get('/pelanggan/create', [PelangganController::class, 'create'])->middleware('role:user')->name('pelanggan.create');
    Route::post('/pelanggan', [PelangganController::class, 'store'])->middleware('role:user')->name('pelanggan.store');
    Route::get('/pelanggan/{id}/edit', [PelangganController::class, 'edit'])->middleware('role:user')->name('pelanggan.edit');
    Route::put('/pelanggan/{id}', [PelangganController::class, 'update'])->middleware('role:user')->name('pelanggan.update');
    Route::delete('/pelanggan/{id}', [PelangganController::class, 'destroy'])->middleware('role:user')->name('pelanggan.destroy');
    Route::get('/pelanggan/print/data', [PelangganController::class, 'print'])->middleware('role:user')->name('pelanggan.print');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
