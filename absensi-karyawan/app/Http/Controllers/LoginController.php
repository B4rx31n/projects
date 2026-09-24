<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('login_admin');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Hardcoded username dan password
        $validUsername = 'admin';
        $validPassword = 'admin123';

        $inputUsername = $request->input('username');
        $inputPassword = $request->input('password');

        if ($inputUsername === $validUsername && $inputPassword === $validPassword) {
            // Set session login sukses
            $request->session()->put('admin_logged_in', true);
            return redirect()->route('dashboard');
        } else {
            // Gagal login
            return back()->withErrors(['login_error' => 'Username atau password salah.'])->withInput();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
