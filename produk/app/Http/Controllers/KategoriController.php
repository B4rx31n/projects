<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = Kategori::paginate(10);
        return view('kategori.index', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // 1. Definisikan aturan validasi
        $request->validate([
            'nama_kategori' => 'required|min:3|max:30|unique:kategoris,nama_kategori',
        ], [
            // Custom pesan error
            'nama_kategori.required' => 'Nama kategori tidak boleh kosong!',
            'nama_kategori.min' => 'Nama kategori minimal 3 karakter.',
            'nama_kategori.max' => 'Nama kategori maksimal 30 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada.',
        ]);

        // 2. Jika lolos, simpan data
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        // 3. Beri notifikasi sukses
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->produks()->count() > 0) {
            return redirect()->route('kategori.index')->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh produk.');
        }

        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus!');
    }
}