<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $fillable = ['nama_barang', 'kategori_id', 'jumlah'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Validation rules
    public static $rules = [
        'nama_barang' => 'required|string|max:100',
        'kategori_id' => 'required|exists:kategoris,id',
        'jumlah' => 'required|integer|min:0'
    ];

    public static $messages = [
        'nama_barang.required' => 'Nama barang wajib diisi',
        'nama_barang.string' => 'Nama barang harus berupa teks',
        'nama_barang.max' => 'Nama barang maksimal 100 karakter',
        'kategori_id.required' => 'Kategori wajib dipilih',
        'kategori_id.exists' => 'Kategori tidak valid',
        'jumlah.required' => 'Jumlah wajib diisi',
        'jumlah.integer' => 'Jumlah harus berupa angka',
        'jumlah.min' => 'Jumlah minimal 0'
    ];
}