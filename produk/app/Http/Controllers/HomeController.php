<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;  // PAKAI 1 'i' saja
use App\Models\Supplier;

class HomeController extends Controller
{
    public function index()
    {
        try {
            $data = [
                'produk_count' => Produk::count(),
                'kategori_count' => Kategori::count(),  // PAKAI Kategori (1 i)
                'supplier_count' => Supplier::count(),
            ];
        } catch (\Exception $e) {
            // Jika tabel belum ada, kasih nilai default
            $data = [
                'produk_count' => 0,
                'kategori_count' => 0,
                'supplier_count' => 0,
            ];
        }
        
        return view('home', $data);
    }
}