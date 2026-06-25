<?php

return [
    'starter' => [
        'name' => 'Starter',
        'price' => '$9',
        'period' => 'month',
        'conversation_limit' => 100,
        'summary' => 'For one business testing AI lead capture.',
        'features' => [
            'Hosted AI lead page',
            'Lead dashboard',
            'Business profile, services, and FAQs',
            'Email lead notifications',
            'Website widget',
        ],
    ],
    'growth' => [
        'name' => 'Growth',
        'price' => '$29',
        'period' => 'month',
        'conversation_limit' => 500,
        'summary' => 'For businesses with steady website or campaign traffic.',
        'features' => [
            'Everything in Starter',
            'Higher monthly AI conversation limit',
            'Lead status tracking',
            'Conversation history',
            'Priority setup support',
        ],
    ],
    'pro' => [
        'name' => 'Pro',
        'price' => '$59',
        'period' => 'month',
        'conversation_limit' => 2000,
        'summary' => 'For agencies, multi-location teams, and higher-volume businesses.',
        'features' => [
            'Everything in Growth',
            'Larger conversation allowance',
            'Multiple campaign entry points',
            'Advanced notification options',
            'Monthly performance review',
        ],
    ],
];
