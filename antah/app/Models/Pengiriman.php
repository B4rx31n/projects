<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';

    protected $fillable = [
        'anggota_id', 
        'produk_id', 
        'jumlah_kiriman', 
        'tanggal_pemesanan', 
        'tanggal_pengiriman', 
        'status_pembayaran', 
        'keterangan'
    ];

    /**
     * Relasi ke Model Anggota (Satu pengiriman untuk satu anggota)
     */
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }

    /**
     * Relasi ke Model Produk (Satu pengiriman untuk satu produk)
     */
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
