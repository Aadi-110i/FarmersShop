<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->registered(function ($app) {
        if (env('VERCEL')) {
            $app->useStoragePath('/tmp/storage');
            
            // Ensure necessary directories exist in /tmp
            $directories = [
                '/tmp/storage/framework/views',
                '/tmp/storage/framework/cache',
                '/tmp/storage/framework/sessions',
                '/tmp/storage/logs',
            ];

            foreach ($directories as $directory) {
                if (!is_dir($directory)) {
                    mkdir($directory, 0755, true);
                }
            }
        }
    })
    ->create();
