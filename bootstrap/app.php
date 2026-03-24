<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Exceptions\UnauthorizedException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        $middleware->alias([
            'role'               => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission'         => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,

            // ✅ Only new line added — your custom redirect middleware
            'role.redirect'      => \App\Http\Middleware\RoleRedirect::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (UnauthorizedException|AuthorizationException $e, $request) {
            if (!auth()->check()) {
                return redirect()->route('login');
            }

            $user = auth()->user();

            if ($user->hasRole('super_admin')) {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'You are not allowed to access that page.');
            }

            if ($user->hasRole('business_admin')) {
                return redirect()->route('business.dashboard')
                    ->with('error', 'You are not allowed to access that page.');
            }

            if ($user->hasRole('cashier')) {
                return redirect()->route('cashier.terminal')
                    ->with('error', 'You are not allowed to access that page.');
            }

            if ($user->hasRole('customer')) {
                return redirect()->route('customer.account')
                    ->with('error', 'You are not allowed to access that page.');
            }

            return redirect()->route('dashboard')
                ->with('error', 'You are not allowed to access that page.');
        });
    })->create();
