<?php

namespace App\Models;

use App\Models\Scopes\OrderScopes;
use Illuminate\Contracts\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected static function booted(): void
    {
        static::addGlobalScope(new OrderScopes);
    }

    protected $fillable = [
        'user_id',
        'service_type',
        'teknisi_id',
        'device_problem',
        'address',
        'appointment_date',
    ];

    

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function manageService()
    {
        return $this->belongsTo(ManageServices::class, 'service_type');
    }
}
