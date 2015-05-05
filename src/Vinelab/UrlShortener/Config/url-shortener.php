<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default URL Shortening provider
    |--------------------------------------------------------------------------
    |
    | Supported Providers: bitly
    |
    */
    'default' => 'bitly',

    /*
    |--------------------------------------------------------------------------
    | URL Shortening Providers
    |--------------------------------------------------------------------------
    |
    | Here are each of the URL Shortening Providers configuration.
    |
    */
    'drivers' => [

        'bitly' => [

            'token' => 'YOUR-TOKEN-HERE',

        ],

    ],

];
