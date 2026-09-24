<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\FormController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/game', [GameController::class, 'index'])->name('game.index');
Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
Route::post('/game', [GameController::class, 'store'])->name('game.store');

Route::get('/form/step1', [FormController::class, 'step1']);
Route::get('/form/step2', [FormController::class, 'step2']);
Route::get('/form/step3', [FormController::class, 'step3']);
