<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('inventory');
});

Route::prefix('api')->group(function () {
    Route::resource('barang', 'App\Http\Controllers\BarangController');
    Route::resource('penerima', 'App\Http\Controllers\PenerimaController');
    Route::resource('penyerahan', 'App\Http\Controllers\PenyerahanController');
    
    Route::get('lokasi-data', function() {
        return response()->json([
            'Labor' => [
                'RPL' => ['Labor RPL 1','Labor RPL 2','Labor RPL 3'],
                'PSPT' => ['Labor PSPT 1'],
                'DKV' => ['Labor DKV 1','Labor DKV 2','Labor DKV 3'],
                'TKJ' => ['Labor TKJ 1','Labor TKJ 2','Labor TKJ 3','Labor TKJ 4']
            ],
            'Lokal' => [
                'RPL' => ['X RPL 1','XI RPL 1','XI RPL 2'],
                'PSPT' => ['X PSPT 1','X PSPT 2','XI PSPT 1'],
                'DKV' => ['X DKV 1','X DKV 2','XI DKV 1','XI DKV 2','XI DKV 3'],
                'TKJ' => ['X TKJ 1','X TKJ 2','XI TKJ 1','XI TKJ 2']
            ]
        ]);
    });
});