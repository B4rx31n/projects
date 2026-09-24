<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $fillable = [
        'nama',
        'tanggal',
        'jam',
    ];

    public $timestamps = false;

    // Accessor to ensure jam is parsed as a Carbon instance (time)
    public function getJamAttribute($value)
    {
        return Carbon::parse($value);
    }

    // Mutator to ensure jam is stored in consistent time format
    public function setJamAttribute($value)
    {
        $this->attributes['jam'] = Carbon::parse($value)->format('H:i:s');
    }
}
