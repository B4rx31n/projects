<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'content',
        'status',
        'admin_response',
    ];

    protected function casts(): array
    {
        return [
            'status' => 'string',
        ];
    }
}
