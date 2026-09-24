<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    public function create()
    {
        return view('user.create-report');
    }

    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Report::create([
            'content' => $request->content,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim secara anonim.');
    }

    public function publicIndex()
    {
        $reports = Report::where('status', 'responded')
            ->orderBy('updated_at', 'desc')
            ->paginate(10);
        
        return view('reports.public', compact('reports'));
    }
}
