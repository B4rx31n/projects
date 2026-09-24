<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Produk;
use App\Models\Anggota;
use App\Models\Supplier;
use App\Models\Pengiriman;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin/dashboard');
        }

        return redirect()->back()->withInput()->with('error', 'Email atau password salah.');
    }

    public function dashboard()
    {
        $produkCount = Produk::count();
        $anggotaCount = Anggota::count();
        $supplierCount = Supplier::count();
        $pengirimanCount = Pengiriman::count();
        
        return view('admin.dashboard', compact('produkCount', 'anggotaCount', 'supplierCount', 'pengirimanCount'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }

    public function loginGabungan(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:admin,user',
        ]);

        $credentials = $request->only('email', 'password');
        $role = $request->role;

        if ($role === 'admin') {
            if (Auth::guard('admin')->attempt($credentials)) {
                return redirect()->intended('/admin/dashboard');
            }
        } elseif ($role === 'user') {
            if (Auth::attempt($credentials)) {
                return redirect()->intended('/user/dashboard');
            }
        }

        return redirect()->back()->withInput()->with('error', 'Email atau password salah untuk role ' . ucfirst($role) . '.');
    }
}
