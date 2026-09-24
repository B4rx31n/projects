<?php

namespace App\Http\Controllers;

use App\Models\Penerima;
use Illuminate\Http\Request;

class PenerimaController extends Controller
{
    public function index()
    {
        return Penerima::all();
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_penerima' => 'required|unique:penerimas',
            'nama' => 'required'
        ]);

        return Penerima::create($request->all());
    }

    // 🔥 Tambahkan fungsi ini untuk hapus semua data
    public function clearSemua()
    {
        try {
            Penerima::truncate(); // Hapus semua data
            return response()->json(['message' => 'Semua data berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Gagal menghapus data: ' . $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        $penerima = \App\Models\Penerima::findOrFail($id);
        $penerima->delete();
        return response()->json(['message' => 'Penerima deleted successfully']);
    }
}
