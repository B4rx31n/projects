<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Penerima;
use App\Models\Penyerahan;

class ClearController extends Controller
{
    public function clearAll()
    {
        Penyerahan::truncate();
        Barang::truncate();
        Penerima::truncate();

        return response()->json(['message' => 'Semua data berhasil dihapus.']);
    }
}