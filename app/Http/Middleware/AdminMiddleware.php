<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        // Pastikan user sudah login dan memiliki role "Admin"
        if (Auth::check() && Auth::user()->role->name === 'Admin') {
            return $next($request);
        }

        // Jika tidak, kembalikan response Forbidden (403)
        return abort(403);
    }
}
