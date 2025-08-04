<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        // Ambil token dari header Authorization
        $token = $request->header('Authorization');

        // Ganti ini dengan token kamu sendiri
        $expectedToken = 'Bearer rahasiaku123';

        // Cek apakah token cocok
        if ($token !== $expectedToken) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
