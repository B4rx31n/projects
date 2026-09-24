<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pelanggan extends Model
{
    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'no_telepon',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
