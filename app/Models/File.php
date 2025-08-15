<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $table = 'files'; // tabel yang dipakai

    protected $fillable = [
        'user_id',
        'file_name',
        'file_path',
        'file_type',
        'file_size'
    ];

    public $timestamps = true;
}
