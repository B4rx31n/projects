<?php

namespace App\Http\Controllers;

use App\Models\Penyerahan;
use Illuminate\Http\Request;

class PenyerahanController extends Controller
{
    public function index()
    {
        return Penyerahan::with(['barang', 'penerima'])->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|exists:barangs,id',
            'penerima_id' => 'required|exists:penerimas,id',
            'tanggal' => 'required|date'
        ]);

        return Penyerahan::create($request->all());
    }
}