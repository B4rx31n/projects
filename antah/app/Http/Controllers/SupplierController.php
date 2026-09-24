<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier'   => ['required', 'string', 'max:50', 'not_regex:/^\d+$/'],
            'alamat_kota'     => ['required', 'min:2', 'max:100', 'not_regex:/^\d+$/'],
            'contact_person'  => ['required', 'numeric', 'min:10'],

            // FIELD BARU
            'nama_barang'     => ['required', 'string', 'max:100'],
            'jumlah_pasokan'  => ['required', 'integer', 'min:1'],
        ], [
            'nama_supplier.required' => 'Nama supplier wajib diisi',
            'nama_supplier.not_regex'=> 'Nama supplier tidak boleh berupa angka',
            'nama_supplier.max'      => 'Nama supplier maksimal 50 karakter',

            'alamat_kota.required'   => 'Alamat wajib diisi',
            'alamat_kota.not_regex'  => 'Alamat tidak boleh berupa angka',
            'alamat_kota.min'        => 'Alamat minimal 2 karakter',

            'contact_person.required'=> 'Nomor kontak wajib diisi',
            'contact_person.numeric' => 'Nomor kontak harus berupa angka',
            'contact_person.min'     => 'Nomor kontak minimal 10',
            
            'nama_barang.required'   => 'Nama barang wajib diisi',
            'jumlah_pasokan.required'=> 'Jumlah pasokan wajib diisi',
            'jumlah_pasokan.min'     => 'Jumlah pasokan minimal 1',
        ]);

        Supplier::create([
            'nama_supplier'  => $request->nama_supplier,
            'alamat_kota'    => $request->alamat_kota,
            'contact_person' => $request->contact_person,

            // FIELD BARU
            'nama_barang'    => $request->nama_barang,
            'jumlah_pasokan' => $request->jumlah_pasokan,
        ]);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('supplier.detail', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'nama_supplier'   => ['required', 'string', 'max:50', 'not_regex:/^\d+$/'],
            'alamat_kota'     => ['required', 'min:2', 'max:100', 'not_regex:/^\d+$/'],
            'contact_person'  => ['required', 'numeric', 'min:10'],

            'nama_barang'     => ['required', 'string'],
            'jumlah_pasokan'  => ['required', 'integer', 'min:1'],
        ]);

        $supplier->update([
            'nama_supplier'  => $request->nama_supplier,
            'alamat_kota'    => $request->alamat_kota,
            'contact_person' => $request->contact_person,

            'nama_barang'    => $request->nama_barang,
            'jumlah_pasokan' => $request->jumlah_pasokan,
        ]);

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Supplier berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('supplier.index')
            ->with('error', 'Supplier berhasil dihapus!');
    }
}
