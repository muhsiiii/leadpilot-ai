<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = [
        'business_id',
        'question',
        'answer',
    ];

    public function business()
    {
        return $this->belongsTo(Business::class);
    }
}
