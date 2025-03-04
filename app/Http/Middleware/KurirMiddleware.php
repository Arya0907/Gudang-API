<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class KurirMiddleware
{
    public function handle(Request $request, Closure $next, ...$guards): Response
    {
        // Pastikan user sudah login dan memiliki role 'kurir'
        if (!$request->user() || $request->user()->role !== 'kurir') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return $next($request);
    }
}
