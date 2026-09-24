<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table= 'produks';
    protected $fillable = ['nama_barang', 'jumlah'];

    /**
     * Relasi ke Pengiriman (Satu produk bisa dikirim berkali-kali)
     */
    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class, 'produk_id');
    }
}

