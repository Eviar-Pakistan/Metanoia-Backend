
// in class Kernel extends HttpKernel
protected $middleware = [
    // ... existing middleware ...
    \App\Http\Middleware\CorsMiddleware::class,
];