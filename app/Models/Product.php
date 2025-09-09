<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    protected static function booted()
    {
        static::created(fn () => Cache::tags(['products'])->flush());
        static::updated(fn () => Cache::tags(['products'])->flush());
        static::deleted(fn () => Cache::tags(['products'])->flush());
    }
}
