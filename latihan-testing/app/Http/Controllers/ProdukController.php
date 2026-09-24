<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Pengiriman; // Tambahkan ini
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::with('kategori', 'supplier')->get();
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris = Kategori::all();
        $suppliers = \App\Models\Supplier::all();
        return view('produk.create', compact('kategoris', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi',
            'jumlah.required' => 'Jumlah barang wajib diisi',
            'jumlah.integer' => 'Jumlah harus berupa angka',
            'kategori_id.required' => 'Kategori wajib dipilih',
            'kategori_id.exists' => 'Kategori tidak valid',
            'harga.required' => 'Harga wajib diisi',
            'harga.numeric' => 'Harga harus berupa angka',
        ]);

        Produk::create($request->all());

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        // Tambahkan data pengiriman terkait
        $pengiriman = Pengiriman::where('produk_id', $produk->id)
            ->with('supplier')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('produk.show', compact('produk', 'pengiriman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $kategoris = Kategori::all();
        $suppliers = \App\Models\Supplier::all();
        return view('produk.edit', compact('produk', 'kategoris', 'suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga' => 'required|numeric|min:0',
        ]);

        $produk->update($request->all());

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        // Cek apakah produk sedang dikirim
        $sedangDikirim = Pengiriman::where('produk_id', $produk->id)
            ->where('status', 'dikirim')
            ->exists();
            
        if ($sedangDikirim) {
            return redirect()
                ->route('produk.index')
                ->with('error', 'Tidak bisa menghapus produk yang sedang dikirim!');
        }
        
        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus.');
    }
    
    /**
     * Method khusus untuk mengelola pengiriman dari produk
     */
    public function kirim(Request $request, Produk $produk)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'jumlah_kirim' => 'required|integer|min:1|max:' . $produk->jumlah,
            'tanggal_kirim' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);
        
        // Proses pengiriman sudah ada di PengirimanController
        // Method ini bisa digunakan untuk custom flow
    }
}