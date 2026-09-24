<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';

    protected $fillable = [
        'kode_anggota',
        'nama',
        'email',
        'telepon',
        'alamat',
        'status',
        'created_by', // tambahkan created_by
    ];

    // Relasi belongsTo ke User
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}