<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    use HasFactory;

    protected $table = 'pengirimans';

    protected $fillable = [
        'supplier_id',
        'produk_id',
        'jumlah_kirim',
        'tanggal_kirim',
        'tanggal_diterima',
        'status',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_kirim' => 'date',
        'tanggal_diterima' => 'date',
    ];

    // Relationship dengan Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    // Relationship dengan Produk
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
