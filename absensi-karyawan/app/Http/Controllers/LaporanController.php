<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanController extends Controller
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

        return view('laporan', [
            'karyawanList' => $karyawanList,
        ]);
    }
}
