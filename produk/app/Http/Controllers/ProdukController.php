<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategori')->paginate(10);
        return view('produk.index', compact('produks'));
    }

    public function data()
    {
        $produks = Produk::with('kategori')->get();
        return response()->json($produks);
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        // 1. Definisikan aturan validasi
        $request->validate([
            'nama_barang' => 'required|min:3|max:50',
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ], [
            // Custom pesan error
            'nama_barang.required' => 'Nama barang tidak boleh kosong ya!',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 50 karakter.',
            'kategori_id.required' => 'Kategori harus dipilih.',
            'jumlah.required' => 'Jumlah tidak boleh kosong.',
            'jumlah.numeric' => 'Isi jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        // 2. Jika lolos, simpan data
        Produk::create([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
        ]);

        // 3. Beri notifikasi sukses (Flash Message)
        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, Produk $produk)
    {
        // 1. Definisikan aturan validasi
        $request->validate([
            'nama_barang' => 'required|min:3|max:50',
            'kategori_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ], [
            // Custom pesan error
            'nama_barang.required' => 'Nama barang tidak boleh kosong ya!',
            'nama_barang.min' => 'Nama barang minimal 3 karakter.',
            'nama_barang.max' => 'Nama barang maksimal 50 karakter.',
            'kategori_id.required' => 'Kategori harus dipilih.',
            'jumlah.required' => 'Jumlah tidak boleh kosong.',
            'jumlah.numeric' => 'Isi jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        // 2. Jika lolos, update data
        $produk->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
        ]);

        // 3. Beri notifikasi sukses (Flash Message)
        return redirect()->route('produk.index')->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }
}