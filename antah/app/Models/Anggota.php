<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table= 'anggotas';
    protected $fillable=['nama_anggota','kota'];

    /**
     * Relasi ke Pengiriman (Satu anggota bisa punya banyak pengiriman)
     */
    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class, 'anggota_id');
    }
}
