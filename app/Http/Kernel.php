<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ...

    protected $routeMiddleware = [
        // middleware bawaan Laravel
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'ensure.token' => \App\Http\Middleware\EnsureTokenIsValid::class,
        'admin' => \App\Http\Middleware\AdminMiddleware::class,
        'role' => \App\Http\Middleware\RoleMiddleware::class, 
    ];
}
