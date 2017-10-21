<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS
    |--------------------------------------------------------------------------
    |
    | allowedOrigins, allowedHeaders and allowedMethods can be set to array('*')
    | to accept any value.
    |
    */

    'supportsCredentials' => false,
    'allowedOrigins' => ['localhost', config('app.url')],
    'allowedHeaders' => [],
    'allowedMethods' => [],
    'exposedHeaders' => [],
    'maxAge' => 0,

];
