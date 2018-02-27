<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'google' => [
        'client_id' => '841955498576-h716mura55f07q6fddt11s6ihoia13m4.apps.googleusercontent.com',
        'client_secret' => 'ueX555uw_y10YxcLncA0hH-b',
        'redirect' => 'http://localhost/login/google/callback',
    ],

    'facebook' => [
        'client_id' => '540611569645359',
        'client_secret' => '7ad42757c5b5e11c902ee2213adc1549',
        'redirect' => 'http://localhost/login/facebook/callback',
    ]

];
