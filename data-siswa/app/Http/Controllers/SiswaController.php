<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        // Search functionality
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        }

        $siswas = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('siswas.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Siswa::create($request->all());

        return redirect()->route('siswas.index')
                         ->with('success', 'Siswa created successfully.');
    }

    public function edit(Siswa $siswa)
    {
        return view('siswas.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:siswas,email,' . $siswa->id,
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $siswa->update($request->all());

        return redirect()->route('siswas.index')
                         ->with('success', 'Siswa updated successfully.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswas.index')
                         ->with('success', 'Siswa deleted successfully.');
    }
}
