<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data extends Model
{
    use HasFactory;
    protected $table = 'datas';

    use HasFactory;
    protected $fillable = ['nip','nama','jenis_kelamin','tll','tamatan','alamat',];
}