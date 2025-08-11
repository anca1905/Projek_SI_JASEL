<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class techniciansApplications extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'province_code',
        'regency_code',
        'subdistrict_code',
        'village_code',
        'reason',
        'phone_number',
        'resume_path',
    ];
}
