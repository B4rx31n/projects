<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TesterController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('Tester', TesterController::class);
