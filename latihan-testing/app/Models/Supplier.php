<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    // PASTIKAN INI SESUAI DENGAN DATABASE
    protected $fillable = [
        'nama',
        'kota',
        'nomor_telepon',
        'created_by', // tambahkan created_by
    ];

    // Relasi belongsTo ke User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Relasi hasMany ke Produk
    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    // Relasi hasMany ke Pengiriman
    public function pengirimans()
    {
        return $this->hasMany(Pengiriman::class);
    }
}