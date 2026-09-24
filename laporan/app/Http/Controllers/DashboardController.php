<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('reports'));
    }

    public function userReports()
    {
        // For users, perhaps show their own reports if not anonymous, but since anonymous, maybe redirect to create
        return redirect()->route('reports.create');
    }

    public function respondForm($id)
    {
        $report = Report::findOrFail($id);
        return view('admin.respond', compact('report'));
    }

    public function respond(Request $request, $id)
    {
        $request->validate([
            'admin_response' => 'required|string|max:1000',
        ]);

        $report = Report::findOrFail($id);
        $report->update([
            'admin_response' => $request->admin_response,
            'status' => 'responded',
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Respon berhasil dikirim.');
    }
}
