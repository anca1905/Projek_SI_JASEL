<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

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
