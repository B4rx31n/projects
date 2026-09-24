<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\datacontroller;

Route::get('tambahdata',[datacontroller::class,'tambahdata'])->name ('tambahdata');
Route::post('simpan',[datacontroller::class,'simpan'])->name ('simpandata');
Route::get('/', [datacontroller::class, 'index']);
Route::get('/edit/{id}', [datacontroller::class, 'edit'])->name('edit');
Route::put('/update/{id}', [datacontroller::class, 'update'])->name('update');
Route::delete('/delete/{id}', [datacontroller::class, 'destroy'])->name('delete');
