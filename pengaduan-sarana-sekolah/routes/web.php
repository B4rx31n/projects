<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }

    return redirect()->route('login');
})->name('root');

Route::middleware('guest')->group(function () {
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login.store');

    Route::get('/register', [\App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::get('/home', \App\Http\Controllers\HomeController::class)
    ->middleware('auth')
    ->name('home');

Route::middleware(['auth', 'role:siswa'])->prefix('siswa')->name('student.')->group(function () {
    Route::get('/aspirasi', [\App\Http\Controllers\StudentAspirationController::class, 'index'])->name('aspirations.index');
    Route::post('/aspirasi', [\App\Http\Controllers\StudentAspirationController::class, 'store'])->name('aspirations.store');
    Route::get('/histori', [\App\Http\Controllers\StudentAspirationController::class, 'history'])->name('aspirations.history');
    Route::get('/aspirasi/{aspiration}', [\App\Http\Controllers\StudentAspirationController::class, 'show'])->name('aspirations.show');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/aspirasi', [\App\Http\Controllers\AdminAspirationController::class, 'index'])->name('aspirations.index');
    Route::get('/aspirasi/{aspiration}', [\App\Http\Controllers\AdminAspirationController::class, 'show'])->name('aspirations.show');
    Route::post('/aspirasi/{aspiration}/feedback', [\App\Http\Controllers\AdminAspirationController::class, 'storeFeedback'])->name('aspirations.feedback.store');
});
