<?php

namespace App\Http\Controllers;

use App\Models\Tester;
use Illuminate\Http\Request;

class TesterController extends Controller
{

    public function index()
    {
        $Tester = Tester::all();
        return view('Tester.index', compact('Tester'));
    }

    public function create()
    {
        return view('Tester.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer',
        ]);

        Tester::create($request->all());

        return redirect()->route('Tester.index')
                         ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $Tester = Tester::findOrFail($id);
        return view('Tester.show', compact('Tester'));
    }

 
    public function edit(string $id)
    {
        $Tester = Tester::findOrFail($id);
        return view('Tester.edit', compact('Tester'));
    }

   
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'  => 'required',
            'harga' => 'required|numeric',
            'stok'  => 'required|integer',
        ]);

        $Tester = Tester::findOrFail($id);
        $Tester->update($request->all());

        return redirect()->route('Tester.index')
                         ->with('success', 'Produk berhasil diupdate');
    }

    
    public function destroy(string $id)
    {
        $Tester = Tester::findOrFail($id);
        $Tester->delete();

        return redirect()->route('Tester.index')
                         ->with('success', 'Produk berhasil dihapus');
    }
}
