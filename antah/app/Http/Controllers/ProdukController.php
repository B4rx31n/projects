<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produks = Produk::all();
        return view('produk.index', compact('produks'));
    }

    /**
     * Show the form for creating a new resource.
     */
// Menampilkan halaman form (Add)
    public function create() {
        return view('produk.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
            $request->validate([
        'nama_barang' => ['required', 'string', 'max:50', 'not_regex:/^\d+$/'],
        'jumlah'      => 'required|numeric|min:1',
    ], [
        'nama_barang.required' => 'Nama barang wajib diisi',
        'nama_barang.string'   => 'Nama barang harus berupa teks',
        'nama_barang.max'      => 'Nama barang maksimal 50 karakter',
        'nama_barang.not_regex' => 'Nama barang tidak boleh hanya berupa angka',
        'jumlah.required'      => 'Jumlah barang wajib diisi',
        'jumlah.numeric'       => 'Jumlah barang harus berupa angka',
        'jumlah.min'           => 'Jumlah barang minimal 1',
    ]);


        // Logika ini sama dengan Produk::create([...]) di Tinker
        Produk::create([
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $request->jumlah,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
/*     
    public function show($id) 
    {
        //var_dump($id);
        $produk = Produk::findOrFail($id);
        //dd($produk);
        //dd($produk);
        return view('produk.detail', compact('produk'));
    }
     */


    public function show(Produk $produk)
    {
        return view('produk.detail', compact('produk'));
    }
    
    /* 
    public function show(Produk $produk)
    {
        // Seperti perintah Tinker: $p = Produk::find(1)
        $produk = Produk::findOrFail($id);
        // Kirim data ke view detail
        return view('produk.detail', compact('produk'));
    }
 */
    
    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Produk $produk) 
    {
        return view('produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Produk $produk)
    {
        $produk->update([
            'nama_barang' => $request->nama_barang,
            'jumlah'      => $request->jumlah,
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk) 
    {
        $produk->delete();
        return redirect()->route('produk.index')->with('error', 'Produk berhasil dihapus!');
    }
}
