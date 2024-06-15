<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\JsonMiddlewareForPostRequests;
use Illuminate\Validation\ValidationException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )

    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(JsonMiddlewareForPostRequests::class);
    })

    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (ValidationException $exception, $request) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Validation error',
                    'status' => false,
                    'errors' => $exception->errors(),
                ], 422);
            }
            return null;
        });
    })
    ->create();
