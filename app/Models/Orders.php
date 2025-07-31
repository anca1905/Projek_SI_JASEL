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

    public function scopeCountOrders($query)
    {
        return $query->withoutGlobalScopes()
            ->where('status', 'menunggu_konfirmasi')
            ->orWhere(function ($q) {
                $q->where('created_at', '>=', now()->subDay())
                    ->where('status', '!=', 'selesai')
                    ->whereNotNull('teknisi_id');
            })
            ->get()
            ->count();
    }

    public function scopeServiceCount($query)
    {
        return $query->withoutGlobalScopes()->where('teknisi_id', '!=', null)->get()->unique('teknisi_id')->count();
    }

    public function scopeOrderStatus($query)
    {
        return $query->withoutGlobalScopes()->where('teknisi_id', auth()->user()->id)->where('status', '!=', 'menunggu_konfirmasi');
    }

    // public function scopeFilterOrders($query) {
    //     return $query->withoutGlobalScopes()->filter
    // }

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
