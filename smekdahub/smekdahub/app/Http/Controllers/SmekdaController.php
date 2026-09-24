<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Forum;
use App\Models\Tanggapan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class SmekdaController extends Controller
{
    // =============== DASHBOARD ===============
    public function dashboard()
    {
        if (Auth::user()->role === 'admin') {
            $allLaporans = Laporan::with(['user', 'tanggapans'])
                ->orderByRaw("FIELD(prioritas, 'tinggi', 'sedang', 'rendah')")
                ->orderBy('created_at', 'desc')
                ->get();

            return view('dashboard_admin', compact('allLaporans'));
        } else {
            $laporans = Laporan::where('user_id', Auth::id())
                ->with('tanggapans')
                ->orderBy('created_at', 'desc')
                ->get();

            return view('dashboard_non_admin', compact('laporans'));
        }
    }

    // =============== LAPORAN ===============
    public function laporanIndex()
    {
        $laporans = Laporan::where('user_id', Auth::id())
            ->with('tanggapans')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('laporan.index', compact('laporans'));
    }

    public function storeLaporan(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'isi_laporan' => 'required|string|min:10'
        ]);

        $isi = strtolower($request->isi_laporan);
        $prioritas = 'rendah';
        
        if (str_contains($isi, 'mendesak') || str_contains($isi, 'darurat')) {
            $prioritas = 'tinggi';
        } elseif (str_contains($isi, 'penting') || str_contains($isi, 'segera')) {
            $prioritas = 'sedang';
        }

        Laporan::create([
            'user_id' => Auth::id(),
            'judul' => $request->judul,
            'isi_laporan' => $request->isi_laporan,
            'prioritas' => $prioritas,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Laporan berhasil dikirim! Prioritas: ' . ucfirst($prioritas));
    }

    // =============== FORUM ===============
    public function forumIndex()
    {
        $forums = Forum::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        
        return view('forum.index', compact('forums'));
    }

    public function storeForum(Request $request)
    {
        $request->validate([
            'pesan' => 'required|string|max:500|min:3'
        ]);

        $badWords = ['bajingan', 'tolol', 'goblok', 'anjing', 'bangsat', 'kontol'];
        $pesan = strtolower($request->pesan);
        
        foreach ($badWords as $word) {
            if (str_contains($pesan, $word)) {
                return back()->with('error', 'Pesan mengandung kata tidak pantas!');
            }
        }

        Forum::create([
            'user_id' => Auth::id(),
            'pesan' => $request->pesan
        ]);

        return back()->with('success', 'Pesan berhasil dikirim secara anonim!');
    }

    // =============== ADMIN ===============
    public function adminIndex()
    {
        $laporans = Laporan::with(['user', 'tanggapans'])
            ->orderByRaw("FIELD(prioritas, 'tinggi', 'sedang', 'rendah')")
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.index', compact('laporans'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,proses,selesai',
            'isi_tanggapan' => 'nullable|string|min:5'
        ]);

        $laporan = Laporan::findOrFail($id);
        $laporan->update(['status' => $request->status]);

        // Only create/update tanggapan if isi_tanggapan is provided
        if ($request->filled('isi_tanggapan')) {
            Tanggapan::updateOrCreate(
                ['laporan_id' => $id],
                [
                    'isi_tanggapan' => $request->isi_tanggapan,
                    'admin_id' => Auth::id()
                ]
            );
        }

        return back()->with('success', 'Status laporan berhasil diperbarui!');
    }

    public function destroyLaporan($id)
    {
        $laporan = Laporan::findOrFail($id);
        $laporan->delete();

        return back()->with('success', 'Laporan berhasil dihapus!');
    }

    public function storeTanggapan(Request $request, $id)
    {
        $request->validate([
            'isi_tanggapan' => 'required|string|min:5'
        ]);

        Tanggapan::create([
            'laporan_id' => $id,
            'isi_tanggapan' => $request->isi_tanggapan,
            'admin_id' => Auth::id()
        ]);

        return back()->with('success', 'Tanggapan berhasil dikirim!');
    }

     public function exportPDF()
    {
        $laporans = Laporan::with(['user', 'tanggapans'])
            ->orderByRaw("FIELD(prioritas, 'tinggi', 'sedang', 'rendah')")
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('admin.export_pdf', compact('laporans'));

        return $pdf->download('laporan_admin_' . date('Y-m-d') . '.pdf');
    }
}
