<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => [
                'required',
                'min:3',
                'regex:/^[a-zA-Z\s]+$/'
            ],
            'kota'  => 'required|min:3',
            'nomor_telepon' => 'required|min:10|max:15',
        ], [
            'nama.required'  => 'Nama supplier wajib diisi',
            'nama.min'       => 'Nama supplier minimal 3 karakter',
            'nama.regex'     => 'Nama supplier tidak boleh mengandung angka atau simbol',
            'kota.required'  => 'Kota wajib diisi',
            'kota.min'       => 'Kota minimal 3 karakter',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi',
            'nomor_telepon.min'      => 'Nomor telepon minimal 10 digit',
        ]);

        try {
            // Coba dengan Eloquent dulu
            Supplier::create([
                'nama' => $request->nama,
                'kota' => $request->kota,
                'nomor_telepon' => $request->nomor_telepon,
            ]);
            
        } catch (\Exception $e) {
            // Jika gagal, gunakan DB facade dengan mencoba berbagai nama field
            Log::error('Supplier create error: ' . $e->getMessage());
            
            // Cek field yang ada di database
            $columns = DB::select('SHOW COLUMNS FROM suppliers');
            $columnNames = array_column($columns, 'Field');
            
            $fieldName = 'nomor_telepon';
            if (!in_array('nomor_telepon', $columnNames)) {
                // Coba field alternatif
                $fieldName = 'no_hp';
                if (!in_array('no_hp', $columnNames)) {
                    $fieldName = 'no-telepo';
                }
            }
            
            DB::table('suppliers')->insert([
                'nama' => $request->nama,
                'kota' => $request->kota,
                $fieldName => $request->nomor_telepon,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        return redirect()
            ->route('supplier.index')
            ->with('success', 'Data supplier berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        $supplier->load('pengirimans.produk');
        return view('supplier.show', compact('supplier'));
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
            'nama' => 'required|string|max:255',
            'kota' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:15',
        ]);

        try {
            $supplier->update([
                'nama' => $request->nama,
                'kota' => $request->kota,
                'nomor_telepon' => $request->nomor_telepon,
            ]);
        } catch (\Exception $e) {
            Log::error('Supplier update error: ' . $e->getMessage());
            
            $columns = DB::select('SHOW COLUMNS FROM suppliers');
            $columnNames = array_column($columns, 'Field');
            
            $fieldName = 'nomor_telepon';
            if (!in_array('nomor_telepon', $columnNames)) {
                $fieldName = 'no_hp';
                if (!in_array('no_hp', $columnNames)) {
                    $fieldName = 'no-telepo';
                }
            }
            
            DB::table('suppliers')
                ->where('id', $supplier->id)
                ->update([
                    'nama' => $request->nama,
                    'kota' => $request->kota,
                    $fieldName => $request->nomor_telepon,
                    'updated_at' => now(),
                ]);
        }

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus.');
    }
}