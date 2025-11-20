<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie','subscription', 'subscription/*', 'subscriptions', 'category', 'category/*', 'categories', 'video', 'video/*', 'videos', 'manager', 'manager/*', 'managers','managers/*', 'department', 'department/*', 'departments','departments/*', 'specialization', 'specialization/*', 'specializations','specializations/*', 'hospital', 'hospital/*', 'hospitals','hospitals/*', 'doctor', 'doctor/*', 'doctors','doctors/*', 'patient', 'patient/*', 'patients','patients/*', 'login', 'logout', 'register','/dashboard/statistics','dashboard/statistics','dashboard','users','users/*','user','user/*'],

    'allowed_methods' => ['*'],

    // For production, replace with your actual frontend domains
    'allowed_origins' => env('CORS_ALLOWED_ORIGINS') 
        ? explode(',', env('CORS_ALLOWED_ORIGINS'))
        : ['http://192.168.100.176:8080', 'http://localhost:8080', 'http://127.0.0.1:8080'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    // Set to false for token-based auth (no cookies needed)
    'supports_credentials' => false,

];