<?php

use App\Models\Produk;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PengirimanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminManagementController;

Route::get('/', function () {
    return redirect()->route('login');
});

// Login route untuk redirect dari auth middleware
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::post('/login', [AdminController::class, 'loginGabungan'])->name('login.submit');

// Route pengiriman bisa diakses oleh admin dan user
Route::middleware(['auth.admin.or.user'])->group(function () {
    Route::resource('pengiriman', PengirimanController::class);
    Route::post('pengiriman/{id}/bayar', [PengirimanController::class, 'bayar'])->name('pengiriman.bayar');
});

Route::middleware(['admin'])->group(function () { // AdminMiddleware sudah mengecek auth admin
    Route::resource('produk', ProdukController::class);
    Route::resource('anggota', AnggotaController::class)->parameter('anggota', 'anggota');
    Route::resource('supplier', SupplierController::class)->parameter('supplier', 'supplier');
    Route::resource('admins', AdminManagementController::class)->parameter('admins', 'admin');
});

// User routes
Route::prefix('user')->group(function () {
    Route::get('/login', function () {
        return redirect()->route('admin.login');
    })->name('user.login');
    Route::post('/login', function () {
        return redirect()->route('admin.login');
    })->name('user.login.submit');
    Route::get('/register', [UserController::class, 'showRegisterForm'])->name('user.register');
    Route::post('/register', [UserController::class, 'register'])->name('user.register.submit');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    });
});

// Admin routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard')->middleware('admin');
});