<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AspirationFeedback extends Model
{
    use HasFactory;

    protected $table = 'aspiration_feedback';

    protected $fillable = [
        'aspiration_id',
        'admin_id',
        'message',
        'status_after',
        'progress_percent_after',
    ];

    protected $casts = [
        'progress_percent_after' => 'integer',
    ];

    public function aspiration(): BelongsTo
    {
        return $this->belongsTo(Aspiration::class);
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'admin_id');
    }
}



