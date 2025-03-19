<?php

use App\Http\Middleware\CheckTestAccount;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'CheckTestAccount' => CheckTestAccount::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        if (config('app.env') === 'production') {
            Integration::handles($exceptions);
        }
    })->create();
