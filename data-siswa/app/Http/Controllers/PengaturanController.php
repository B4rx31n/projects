<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PengaturanController extends Controller
{
    public function index()
    {
        return view('pengaturan.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'app_name' => 'required|string|max:255',
            'app_description' => 'nullable|string|max:500',
            'items_per_page' => 'required|integer|min:5|max:100',
            'enable_notifications' => 'nullable|boolean',
        ]);

        // Simpan pengaturan (bisa disimpan di database atau file config)
        // Untuk contoh, kita simpan di session atau bisa dibuat tabel settings
        
        session([
            'app_name' => $request->app_name,
            'app_description' => $request->app_description,
            'items_per_page' => $request->items_per_page,
            'enable_notifications' => $request->has('enable_notifications'),
        ]);

        return redirect()->route('pengaturan.index')
                         ->with('success', 'Pengaturan berhasil diperbarui.');
    }
}

