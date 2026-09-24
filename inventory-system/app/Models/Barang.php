<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode', 'nama', 'jumlah', 'merek', 
        'keperluan', 'sub_kategori', 'lokasi'
    ];

    public function penyerahans()
    {
        return $this->hasMany(Penyerahan::class);
    }
}