<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        return Barang::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:barangs',
            'nama' => 'required',
            'jumlah' => 'required|numeric',
            'merek' => 'required',
            'keperluan' => 'required'
        ]);

        return Barang::create($request->all());
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);
        $barang->delete();
        return response()->json(['message' => 'Barang deleted successfully']);
    }
}