<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Absensi;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class AttendanceHistoryController extends Controller
{
    public function index()
    {
        // Ambil data karyawan dari file JSON
        $path = storage_path('app/karyawan.json');
        if (!file_exists($path)) {
            $karyawanList = [];
        } else {
            $karyawanJson = file_get_contents($path);
            $karyawanList = json_decode($karyawanJson, true);
        }

        // Ubah nama karyawan menjadi huruf kapital semua untuk tampilan di riwayat
        $karyawanListUpper = array_map(function ($karyawan) {
            $karyawan['nama'] = strtoupper($karyawan['nama']);
            return $karyawan;
        }, $karyawanList);

        // Ambil absensi hari ini
        $tanggal = Carbon::now()->format('Y-m-d');
        $absensiHariIniRaw = Absensi::where('tanggal', $tanggal)->orderBy('jam', 'asc')->get();

        // Buat map nama => jam absensi
        $absensiHariIni = [];
        foreach ($absensiHariIniRaw as $absen) {
            $absensiHariIni[$absen->nama] = $absen->jam;
        }

        return view('attendance_history', [
            'karyawanList' => $karyawanListUpper,
            'absensiHariIni' => $absensiHariIni,
            'tanggal' => $tanggal,
        ]);
    }
}
