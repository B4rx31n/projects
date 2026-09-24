<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() 
    {
        $users = User::all();
        return view('user.index', ['user' => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => now(),
        ]);

        return redirect()->route('user')->with('success', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        // Validasi: jika user adalah admin dan ingin diubah ke user, cek apakah masih ada admin lain
        if ($user->role === 'admin' && $request->role === 'user') {
            $adminCount = User::where('role', 'admin')->where('id', '!=', $id)->count();
            if ($adminCount == 0) {
                return back()->withErrors(['role' => 'Minimal harus ada 1 admin di sistem!'])->withInput();
            }
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('user')->with('success', 'User berhasil diupdate!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Validasi: jika user adalah admin, cek apakah masih ada admin lain
        if ($user->role === 'admin') {
            $adminCount = User::where('role', 'admin')->where('id', '!=', $id)->count();
            if ($adminCount == 0) {
                return back()->with('error', 'Tidak bisa menghapus admin terakhir!');
            }
        }

        $user->delete();

        return redirect()->route('user')->with('success', 'User berhasil dihapus!');
    }

    public function print()
    {
        $users = User::all();
        return view('user.print', ['user' => $users]);
    }
}
