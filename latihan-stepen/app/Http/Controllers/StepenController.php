<?php

namespace App\Http\Controllers;

use App\Models\Stepen;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function index()
    {
        $Stepen = Stepen::all();
        return view('Stepen.index', compact('Stepen'));
    }

    public function create()
    {
        return view('Stepen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer',
        ]);

        Stepen::create($request->all());

        return redirect()->route('Stepen.index')
                         ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $Stepen = Stepen::findOrFail($id);
        return view('Stepen.show', compact('Stepen'));
    }

 
    public function edit(string $id)
    {
        $Stepen = Stepen::findOrFail($id);
        return view('Stepen.edit', compact('Stepen'));
    }

   
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer',
        ]);

        $Stepen = Stepen::findOrFail($id);
        $Stepen->update($request->all());

        return redirect()->route('Stepen.index')
                         ->with('success', 'Produk berhasil diupdate');
    }

    
    public function destroy(string $id)
    {
        $Stepen = Stepen::findOrFail($id);
        $Stepen->delete();

        return redirect()->route('Stepen.index')
                         ->with('success', 'Produk berhasil dihapus');
    }
}
