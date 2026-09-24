<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['nama_supplier', 'kota', 'nomor_telepon'];

    // Validation rules
    public static $rules = [
        'nama_supplier' => 'required|string|max:100',
        'kota' => 'required|string|max:50',
        'nomor_telepon' => 'required|string|max:20|regex:/^[0-9+\-\s()]+$/'
    ];

    public static $messages = [
        'nama_supplier.required' => 'Nama supplier wajib diisi',
        'nama_supplier.string' => 'Nama supplier harus berupa teks',
        'nama_supplier.max' => 'Nama supplier maksimal 100 karakter',
        'kota.required' => 'Kota wajib diisi',
        'kota.string' => 'Kota harus berupa teks',
        'kota.max' => 'Kota maksimal 50 karakter',
        'nomor_telepon.required' => 'Nomor telepon wajib diisi',
        'nomor_telepon.string' => 'Nomor telepon harus berupa teks',
        'nomor_telepon.max' => 'Nomor telepon maksimal 20 karakter',
        'nomor_telepon.regex' => 'Format nomor telepon tidak valid'
    ];
}