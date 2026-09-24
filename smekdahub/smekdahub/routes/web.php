<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SmekdaController;

// =============== LANDING PAGE ===============
Route::get('/', function () {
    return view('welcome');
})->name('home');

// =============== GUEST ROUTES ===============
Route::middleware('guest')->group(function () {
    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// =============== AUTHENTICATED ROUTES ===============
Route::middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [SmekdaController::class, 'dashboard'])->name('dashboard');
    
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Laporan
    Route::get('/laporan', [SmekdaController::class, 'laporanIndex'])->name('laporan.index');
    Route::post('/laporan', [SmekdaController::class, 'storeLaporan'])->name('laporan.store');
    
    // Forum
    Route::get('/forum', [SmekdaController::class, 'forumIndex'])->name('forum.index');
    Route::post('/forum', [SmekdaController::class, 'storeForum'])->name('forum.store');
    
    // =============== ADMIN ROUTES ===============
    Route::middleware('can:admin-only')->prefix('admin')->name('admin.')->group(function () {
        // Kelola Laporan
        Route::get('/kelola', [SmekdaController::class, 'adminIndex'])->name('kelola');

        // Update Status Laporan
        Route::put('/laporan/{id}', [SmekdaController::class, 'updateStatus'])->name('laporan.update');

        // Hapus Laporan
        Route::delete('/laporan/{id}', [SmekdaController::class, 'destroyLaporan'])->name('laporan.destroy');

        // Berikan Tanggapan
        Route::post('/laporan/{id}/tanggapan', [SmekdaController::class, 'storeTanggapan'])->name('laporan.tanggapan');

        // Export PDF
        Route::get('/export-pdf', [SmekdaController::class, 'exportPDF'])->name('export.pdf');
    });
});

// =============== FALLBACK ROUTE ===============
Route::fallback(function () {
    return redirect()->route('home');
});