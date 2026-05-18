<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessService extends Model
{
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'price_from',
        'is_active',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
