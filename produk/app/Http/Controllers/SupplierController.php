<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        return view('supplier.index', compact('suppliers'));
    }

    public function create()
    {
        return view('supplier.create');
    }

    public function store(Request $request)
    {
        // 1. Definisikan aturan validasi
        $request->validate([
            'nama_supplier' => 'required|min:3|max:50',
            'kota' => 'required|min:3|max:30',
            'nomor_telepon' => 'required|min:8|max:15',
        ], [
            // Custom pesan error untuk Supplier
            'nama_supplier.required' => 'Nama supplier tidak boleh kosong ya!',
            'nama_supplier.min' => 'Nama supplier minimal 3 karakter.',
            'nama_supplier.max' => 'Nama supplier maksimal 50 karakter.',
            'kota.required' => 'Kota tidak boleh kosong ya!',
            'kota.min' => 'Nama kota minimal 3 karakter.',
            'kota.max' => 'Nama kota maksimal 30 karakter.',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong ya!',
            'nomor_telepon.min' => 'Nomor telepon minimal 8 digit.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 15 digit.',
        ]);

        // 2. Logika tambahan untuk validasi khusus
        $warnings = [];
        
        // Cek apakah nama supplier hanya angka
        if (is_numeric($request->nama_supplier)) {
            $warnings[] = 'Nama supplier seharusnya berupa huruf, bukan angka!';
        }
        
        // Cek apakah kota hanya angka
        if (is_numeric($request->kota)) {
            $warnings[] = 'Nama kota seharusnya berupa huruf, bukan angka!';
        }
        
        // Cek format nomor telepon
        if (!preg_match('/^[0-9+\-\s()]+$/', $request->nomor_telepon)) {
            $warnings[] = 'Nomor telepon hanya boleh berisi angka, +, -, spasi, atau tanda kurung!';
        }
        
        // Cek jika nomor telepon mengandung huruf
        if (preg_match('/[a-zA-Z]/', $request->nomor_telepon)) {
            $warnings[] = 'Nomor telepon tidak boleh mengandung huruf!';
        }

        // 3. Jika lolos, simpan data
        $supplier = Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'kota' => $request->kota,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        // 4. Beri notifikasi sukses
        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil ditambahkan!')
            ->with('warnings', $warnings);
    }

    public function edit(Supplier $supplier)
    {
        return view('supplier.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        // 1. Definisikan aturan validasi
        $request->validate([
            'nama_supplier' => 'required|min:3|max:50',
            'kota' => 'required|min:3|max:30',
            'nomor_telepon' => 'required|min:8|max:15',
        ], [
            // Custom pesan error untuk Supplier
            'nama_supplier.required' => 'Nama supplier tidak boleh kosong ya!',
            'nama_supplier.min' => 'Nama supplier minimal 3 karakter.',
            'nama_supplier.max' => 'Nama supplier maksimal 50 karakter.',
            'kota.required' => 'Kota tidak boleh kosong ya!',
            'kota.min' => 'Nama kota minimal 3 karakter.',
            'kota.max' => 'Nama kota maksimal 30 karakter.',
            'nomor_telepon.required' => 'Nomor telepon tidak boleh kosong ya!',
            'nomor_telepon.min' => 'Nomor telepon minimal 8 digit.',
            'nomor_telepon.max' => 'Nomor telepon maksimal 15 digit.',
        ]);

        // 2. Logika tambahan untuk validasi khusus
        $warnings = [];
        
        // Cek apakah nama supplier hanya angka
        if (is_numeric($request->nama_supplier)) {
            $warnings[] = 'Nama supplier seharusnya berupa huruf, bukan angka!';
        }
        
        // Cek apakah kota hanya angka
        if (is_numeric($request->kota)) {
            $warnings[] = 'Nama kota seharusnya berupa huruf, bukan angka!';
        }
        
        // Cek format nomor telepon
        if (!preg_match('/^[0-9+\-\s()]+$/', $request->nomor_telepon)) {
            $warnings[] = 'Nomor telepon hanya boleh berisi angka, +, -, spasi, atau tanda kurung!';
        }
        
        // Cek jika nomor telepon mengandung huruf
        if (preg_match('/[a-zA-Z]/', $request->nomor_telepon)) {
            $warnings[] = 'Nomor telepon tidak boleh mengandung huruf!';
        }

        // 3. Jika lolos, update data
        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'kota' => $request->kota,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        // 4. Beri notifikasi sukses
        return redirect()->route('supplier.index')
            ->with('success', 'Supplier berhasil diperbarui!')
            ->with('warnings', $warnings);
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}