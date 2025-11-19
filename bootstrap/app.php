<?php

use App\Http\Middleware\CheckUserRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['CheckUserRole' => CheckUserRole::class]);
        
        // Exempt routes from CSRF verification for API clients (using Bearer tokens)
        $middleware->validateCsrfTokens(except: [
            'subscription',
            'subscription/*',
            'subscriptions',
            'category',
            'category/*',
            'categories',
            'login',
            'logout',
            'register',
            'video',
            'video/*',
            'videos',
            'manager',
            'manager/*',
            'managers/*',
            'managers',
            'department',
            'department/*',
            'departments',
            'specialization',
            'specialization/*',
            'specializations',
            'hospitals',
            'hospitals/*',
            'hospital',
            'hospital/*',
            'doctor',
            'doctor/*',
            'doctors',
            'doctors/*',
            'patient',
            'patient/*',
            'patients', 
            'patients/*',
            'dashboard/statistics',
            '/dashboard/statistics',
            'dashboard',
            
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
