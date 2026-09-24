<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnggotaController;
// use App\Http\Controllers\PinjamController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route utama redirect ke dashboard
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Resource Routes
Route::resource('produk', ProdukController::class);
Route::resource('user', UserController::class);
Route::resource('supplier', SupplierController::class);
Route::resource('anggota', AnggotaController::class);

// Atau jika ingin lebih rapi, kelompokkan dengan middleware
Route::middleware(['web'])->group(function () {
    Route::resource('produk', ProdukController::class);
    Route::resource('user', UserController::class);
    Route::resource('supplier', SupplierController::class);
    Route::resource('anggota', AnggotaController::class);
});