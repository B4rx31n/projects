<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyerahan extends Model
{
    use HasFactory;

    protected $fillable = ['barang_id', 'penerima_id', 'tanggal'];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function penerima()
    {
        return $this->belongsTo(Penerima::class);
    }
}