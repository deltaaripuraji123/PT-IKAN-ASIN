protected $routeMiddleware = [
    // ... middleware lainnya
    'admin' => \App\Http\Middleware\IsAdmin::class,
];