<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'business_id',
        'visitor_token',
        'name',
        'phone',
        'email',
        'requirement',
        'preferred_date',
        'status',
        'source',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
