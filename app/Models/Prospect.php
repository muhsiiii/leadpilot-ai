<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    protected $fillable = [
        'business_name',
        'category',
        'area',
        'website',
        'phone',
        'contact_channel',
        'public_signal',
        'pain_hypothesis',
        'proposed_solution',
        'budget_fit',
        'priority_score',
        'status',
        'last_contacted_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'last_contacted_at' => 'datetime',
        ];
    }
}
