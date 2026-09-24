<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = Anggota::all();
        return view('anggota.index', compact('anggotas'));
    }

    /**
     * Show the form for creating a new resource.
     */
// Menampilkan halaman form (Add)
    public function create() {
        return view('anggota.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) {
            $request->validate([
    'nama_anggota' => ['required', 'string', 'not_regex:/^\d+$/', 'max:50'],
    'kota'         => ['required', 'string', 'not_regex:/^\d+$/', 'min:2'],
], [
    'nama_anggota.required' => 'Nama anggota wajib diisi',
    'nama_anggota.not_regex'=> 'Nama anggota tidak boleh berupa angka',
    'nama_anggota.max'      => 'Nama anggota maksimal 50 karakter',

    'kota.required'         => 'Alamat kota wajib diisi',
    'kota.not_regex'        => 'Alamat kota tidak boleh hanya berupa angka',
    'kota.min'              => 'Alamat kota minimal 2 karakter',
]);


        // Logika ini sama dengan Anggota::create([...]) di Tinker
        Anggota::create([
            'nama_anggota' => $request->nama_anggota,
            'kota'      => $request->kota,
        ]);

        return redirect()->route('anggota.index')->with('success', 'anggota berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
/*     
    public function show($id) 
    {
        //var_dump($id);
        $anggota = anggota::findOrFail($id);
        //dd($anggota);
        //dd($anggota);
        return view('anggota.detail', compact('anggota'));
    }
     */


    public function show(Anggota $anggota)
    {
        return view('anggota.detail', compact('anggota'));
    }
    
    /* 
    public function show(anggota $anggota)
    {
        // Seperti perintah Tinker: $p = anggota::find(1)
        $anggota = anggota::findOrFail($id);
        // Kirim data ke view detail
        return view('anggota.detail', compact('anggota'));
    }
 */
    
    /**
     * Show the form for editing the specified resource.
     */
  public function edit(Anggota $anggota) 
    {
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
  public function update(Request $request, Anggota $anggota)
    {
        $anggota->update([
            'nama_anggota' => $request->nama_anggota,
            'kota'      => $request->kota,
        ]);

        return redirect()->route('anggota.index')->with('success', 'anggota berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Anggota $anggota) 
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('error', 'anggota berhasil dihapus!');
    }
}
