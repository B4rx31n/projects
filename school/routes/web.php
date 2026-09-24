<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolController;

Route::get('/', function () {
    return redirect()->route('schools.index');
});

Route::resource('schools', SchoolController::class);
