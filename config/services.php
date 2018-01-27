<?php

return [

    // 'mailgun' => [
    //     'domain' => env('MAILGUN_DOMAIN'),
    //     'secret' => env('MAILGUN_SECRET'),
    // ],

    // 'ses' => [
    //     'key' => env('SES_KEY'),
    //     'secret' => env('SES_SECRET'),
    //     'region' => 'us-east-1',
    // ],

    // 'sparkpost' => [
    //     'secret' => env('SPARKPOST_SECRET'),
    // ],

    // 'stripe' => [
    //     'model' => App\User::class,
    //     'key' => env('STRIPE_KEY'),
    //     'secret' => env('STRIPE_SECRET'),
    // ],
    
    'facebook' => [
        'client_id' => '282875052239233',
        'client_secret' => '1139017fa37dd828054b3d4f512308fd',
        'redirect' => url('auth/facebook/callback')
    ],

    'google' => [
        'client_id' => '845163377358-elev6ai06b6vrmcp2rvcao3grll61m8m.apps.googleusercontent.com',
        'client_secret' => 'kNw8FizXb-XdJM8Lrlgq-ouv',
        'redirect' => url('auth/google/callback')
    ]

];
