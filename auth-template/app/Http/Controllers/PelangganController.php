<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index() 
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            $pelanggans = Pelanggan::all();
        } else {
            $pelanggans = $user->pelanggans;
        }
        
        return view('pelanggan.index', ['pelanggans' => $pelanggans]);
    }

    public function create()
    {
        $user = auth()->user();
        return view('pelanggan.create', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        $user = auth()->user();

        Pelanggan::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $user = auth()->user();

        // Pastikan user hanya bisa edit pelanggan miliknya
        if ($user->role !== 'admin' && $pelanggan->user_id !== $user->id) {
            return redirect()->route('pelanggan')->with('error', 'Unauthorized');
        }

        return view('pelanggan.edit', ['pelanggan' => $pelanggan]);
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $user = auth()->user();

        // Pastikan user hanya bisa edit pelanggan miliknya
        if ($user->role !== 'admin' && $pelanggan->user_id !== $user->id) {
            return redirect()->route('pelanggan')->with('error', 'Unauthorized');
        }

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'kota' => 'nullable|string|max:100',
            'provinsi' => 'nullable|string|max:100',
            'kode_pos' => 'nullable|string|max:10',
        ]);

        $pelanggan->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telepon' => $request->no_telepon,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'kode_pos' => $request->kode_pos,
        ]);

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil diupdate!');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $user = auth()->user();

        // Pastikan user hanya bisa hapus pelanggan miliknya
        if ($user->role !== 'admin' && $pelanggan->user_id !== $user->id) {
            return redirect()->route('pelanggan')->with('error', 'Unauthorized');
        }

        $pelanggan->delete();

        return redirect()->route('pelanggan')->with('success', 'Pelanggan berhasil dihapus!');
    }

    public function print()
    {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            $pelanggans = Pelanggan::all();
        } else {
            $pelanggans = $user->pelanggans;
        }
        
        return view('pelanggan.print', ['pelanggans' => $pelanggans]);
    }
}
