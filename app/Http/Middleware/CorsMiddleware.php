<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // You can replace these with your dev origins or read from config
        $allowedOrigins = [
            'http://localhost:8080',
            'http://127.0.0.1:8080',
            'http://192.168.0.104:8080',
            'http://192.168.0.100:8080',
            'http://192.168.0.176:8080',
        ];

        $origin = $request->headers->get('Origin');

        // If preflight, return 204 with appropriate headers
        if ($request->getMethod() === 'OPTIONS') {
            $response = response('', 204);
        } else {
            $response = $next($request);
        }

        if ($origin && in_array($origin, $allowedOrigins, true)) {
            $response->headers->set('Access-Control-Allow-Origin', $origin);
            // If you use cookies/auth from the client, also set Allow-Credentials true
            // $response->headers->set('Access-Control-Allow-Credentials', 'true');
        }

        $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS');
        $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization, X-Requested-With');
        // Optionally expose headers:
        // $response->headers->set('Access-Control-Expose-Headers', 'X-My-Custom-Header');

        return $response;
    }
}