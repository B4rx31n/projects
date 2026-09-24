<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
{
    if (Auth::user()->role === 'admin') {
        $complaints = Complaint::with('user')->get();
        return view('admin.dashboard', compact('complaints'));  // Mengarah ke file baru
    } else {
        $complaints = Auth::user()->complaints;
        return view('siswa.dashboard', compact('complaints'));
    }
}
    public function storeComplaint(Request $request)
{
    $request->validate(['description' => 'required']);

    Complaint::create([
        'user_id' => Auth::id(),
        'description' => $request->description,
    ]);

    return back()->with('success', 'Pengaduan berhasil diajukan.');
}

    public function updateComplaint(Request $request, Complaint $complaint)
{
    $request->validate([
        'status' => 'required|in:pending,diproses,selesai',
        'admin_note' => 'nullable|string',
    ]);
    $complaint->update($request->only(['status', 'admin_note']));
    return back()->with('success', 'Status pengaduan diperbarui.');
}
}