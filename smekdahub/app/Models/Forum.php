<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $fillable = [
        'user_id',
        'pesan'
    ];

    protected $casts = [
        'created_at' => 'datetime:d/m/Y H:i',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor untuk nama anonim
    public function getNamaAnonimAttribute()
    {
        return 'Anonim #' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    // Accessor untuk avatar anonim
    public function getAvatarAnonimAttribute()
    {
        $colors = ['primary', 'success', 'warning', 'danger', 'info', 'secondary'];
        $color = $colors[$this->id % count($colors)];
        return $color;
    }
}