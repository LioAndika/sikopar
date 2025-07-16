<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RoleMiddleware; // Ini sudah ada
use App\Http\Middleware\EnsureUserHasRoleOrIsSuperAdmin; // <-- Tambahkan ini

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            // Tambahkan alias middleware baru Anda di sini:
            'role.or.superadmin' => EnsureUserHasRoleOrIsSuperAdmin::class, // <-- Tambahkan ini
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();