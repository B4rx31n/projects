<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SupplierController;

Route::get('/test-simple', function() {
    return "✅ TEST SIMPLE - Jika ini muncul, routing bekerja!";
});

// Dashboard
Route::get('/', [HomeController::class, 'index'])->name('dashboard');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Data untuk bootstrap-table (TAMBAHKAN INI!)
Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');

// Resource routes
Route::resource('produk', ProdukController::class);
Route::resource('kategori', KategoriController::class);
Route::resource('supplier', SupplierController::class);

// Demo pages dari template
Route::get('/charts', function () {
    return view('charts.index');
})->name('charts');

Route::get('/tables', function () {
    return view('tables.index');
})->name('tables');

Route::get('/forms', function () {
    return view('forms.index');
})->name('forms');

Route::get('/panels', function () {
    return view('panels.index');
})->name('panels');

Route::get('/widgets', function () {
    return view('widgets.index');
})->name('widgets');

// Route login sederhana (optional)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Route logout sederhana (optional)
Route::post('/logout', function () {
    return redirect('/login');
})->name('logout');