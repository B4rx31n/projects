<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    protected $fillable = [
        'laporan_id',
        'isi_tanggapan',
        'admin_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
    ];

    public function laporan()
    {
        return $this->belongsTo(Laporan::class);
    }

    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}