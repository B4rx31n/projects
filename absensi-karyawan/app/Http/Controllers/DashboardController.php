<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Pastikan admin sudah login, jika tidak redirect ke login
        if (!$request->session()->get('admin_logged_in')) {
            return redirect()->route('login');
        }

        $tanggal = Carbon::now()->format('Y-m-d');

        // Load data karyawan
        $path = storage_path('app/karyawan.json');
        if (!file_exists($path)) {
            $karyawanList = [];
        } else {
            $karyawanJson = file_get_contents($path);
            $karyawanList = json_decode($karyawanJson, true);
        }

        $totalKaryawan = count($karyawanList);

        // Hitung hadir hari ini
        $hadirHariIni = Absensi::where('tanggal', $tanggal)->distinct('nama')->count('nama');

        // Hitung terlambat (jam > '09:00:00')
        $terlambat = Absensi::where('tanggal', $tanggal)->where('jam', '>', '09:00:00')->count();

        $tidakHadir = $totalKaryawan - $hadirHariIni;

        // Ambil 20 absensi terbaru
        $absensiTerbaru = Absensi::orderBy('tanggal', 'desc')->orderBy('jam', 'desc')->limit(20)->get();

        // Map absensi data dengan karyawan
        $karyawanMap = [];
        foreach ($karyawanList as $k) {
            $karyawanMap[$k['nama']] = $k;
        }

        return view('dashboard', [
            'totalKaryawan' => $totalKaryawan,
            'hadirHariIni' => $hadirHariIni,
            'terlambat' => $terlambat,
            'tidakHadir' => $tidakHadir,
            'absensiTerbaru' => $absensiTerbaru,
            'karyawanMap' => $karyawanMap,
            'tanggal' => $tanggal,
        ]);
    }

    public function hapus(Request $request, $id)
    {
        if (!$request->session()->get('admin_logged_in')) {
            return redirect()->route('login');
        }

        Absensi::destroy($id);

        return redirect()->route('dashboard');
    }
}
