<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('Test', TestController::class);
Route::get('/test/export-csv', [TestController::class, 'exportCSV'])->name('Test.exportCSV');