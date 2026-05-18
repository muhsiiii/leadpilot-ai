<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'phone',
        'email',
        'address',
        'opening_hours',
        'description',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function services()
    {
        return $this->hasMany(BusinessService::class);
    }

    public function faqs()
    {
        return $this->hasMany(Faq::class);
    }

    public function leads()
    {
        return $this->hasMany(Lead::class);
    }

    public function aiMessages()
    {
        return $this->hasMany(AiMessage::class);
    }
}
