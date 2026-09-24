<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable = ['nama_kategori'];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    // Validation rules
    public static $rules = [
        'nama_kategori' => 'required|string|max:50|unique:kategoris,nama_kategori'
    ];

    public static $messages = [
        'nama_kategori.required' => 'Nama kategori wajib diisi',
        'nama_kategori.string' => 'Nama kategori harus berupa teks',
        'nama_kategori.max' => 'Nama kategori maksimal 50 karakter',
        'nama_kategori.unique' => 'Nama kategori sudah ada'
    ];
}