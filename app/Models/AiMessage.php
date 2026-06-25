<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiMessage extends Model
{
    protected $fillable = [
        'business_id',
        'lead_id',
        'visitor_token',
        'role',
        'message',
        'model',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
