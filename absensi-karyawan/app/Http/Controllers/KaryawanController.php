<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class KaryawanController extends Controller
{
    public function index()
    {
        // Membaca data karyawan dari file JSON
        $path = storage_path('app/karyawan.json');
        if (!file_exists($path)) {
            $karyawanList = [];
        } else {
            $karyawanJson = file_get_contents($path);
            $karyawanList = json_decode($karyawanJson, true);
        }

        // Ubah nama karyawan menjadi huruf kapital semua
        $karyawanListUpper = array_map(function ($karyawan) {
            $karyawan['nama'] = strtoupper($karyawan['nama']);
            return $karyawan;
        }, $karyawanList);

        return view('karyawan', [
            'karyawans' => $karyawanListUpper,
        ]);
    }
}
