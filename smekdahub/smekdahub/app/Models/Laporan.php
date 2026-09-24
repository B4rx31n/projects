<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    protected $fillable = [
        'user_id',
        'judul',
        'isi_laporan',
        'prioritas',
        'status'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tanggapans()
    {
        return $this->hasMany(Tanggapan::class, 'laporan_id');
    }

    // Scope untuk prioritas
    public function scopePrioritasTinggi($query)
    {
        return $query->where('prioritas', 'tinggi');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}