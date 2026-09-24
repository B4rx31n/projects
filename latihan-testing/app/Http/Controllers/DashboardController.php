<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'total_produk' => Produk::count(),
            'total_supplier' => Supplier::count(),
            'total_user' => User::count(),
            'recent_produk' => Produk::latest()->take(5)->get(),
            'recent_supplier' => Supplier::latest()->take(5)->get(),
        ];
        
        return view('dashboard', $data);
    }
}