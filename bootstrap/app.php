<?php
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ProtectorMiddleware;
use App\Http\Middleware\AdopterMiddleware;
use Illuminate\Foundation\Application;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function ($middleware) {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'admin' => AdminMiddleware::class,
            'protector' => ProtectorMiddleware::class,
            'adopter' => AdopterMiddleware::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        //
    })
    ->create();
