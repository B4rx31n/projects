<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function showForm()
    {
        return view('user');
    }

    public function store(Request $request)
    {
        // Validasi input nama
        $request->validate([
            'nama' => 'required|string',
        ]);
        
        $nama = $request->input('nama');
        
        // Load data karyawan dari file JSON menggunakan file_get_contents dengan path lengkap
        $path = storage_path('app/karyawan.json');
        if (!file_exists($path)) {
            $karyawanList = [];
        } else {
            $karyawanJson = file_get_contents($path);
            $karyawanList = json_decode($karyawanJson, true) ?? [];
        }
        
        $found = null;
        
        foreach ($karyawanList as $karyawan) {
            // Bersihkan nama dengan menghapus whitespace, karakter non alfabet dan digit, case insensitive
            $cleanNamaKaryawan = preg_replace('/[^a-z]/', '', strtolower($karyawan['nama'] ?? ''));
            $cleanInputNama = preg_replace('/[^a-z]/', '', strtolower($nama));
            
            if ($cleanNamaKaryawan === $cleanInputNama) {
                $found = $karyawan;
                break;
            }
        }
        
        if (!$found) {
            // Nama tidak terdaftar
            return view('attendance_result', [
                'status' => 'error',
                'messageTitle' => 'NAMA Tidak Terdaftar!',
                'messageBody' => 'NAMA yang Anda masukkan tidak terdaftar dalam sistem.',
            ]);
        }
        
        $tanggal = Carbon::now()->format('Y-m-d');
        $jam = Carbon::now()->format('H:i:s');
        
        // Cek apakah sudah absen hari ini
        $existingAbsensi = Absensi::where('nama', $nama)->where('tanggal', $tanggal)->first();
        
        if ($existingAbsensi) {
            // Sudah absen hari ini
            return view('attendance_result', [
                'status' => 'warning',
                'messageTitle' => 'Sudah Absen Hari Ini!',
                'messageBody' => 'Anda telah melakukan absensi pada:',
                'tanggal' => $tanggal,
                'jam' => $jam,
            ]);
        }
        
        // Simpan absensi
        Absensi::create([
            'nama' => $nama,
            'tanggal' => $tanggal,
            'jam' => $jam,
        ]);
        
        // Redirect ke dashboard dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Anda berhasil melakukan absensi hari ini.');
    }
}
