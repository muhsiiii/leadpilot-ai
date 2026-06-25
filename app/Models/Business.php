<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'slug',
        'type',
        'phone',
        'email',
        'website',
        'address',
        'opening_hours',
        'description',
        'plan',
        'subscription_status',
        'monthly_conversation_limit',
        'lead_email_notifications',
        'ai_instructions',
    ];

    protected $casts = [
        'lead_email_notifications' => 'boolean',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function services()
    {
        return $this->hasMany(BusinessService::class);
    }

    public function activeServices()
    {
        return $this->hasMany(BusinessService::class)->where('is_active', true);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
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
