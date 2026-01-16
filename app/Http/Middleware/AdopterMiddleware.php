<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdopterMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, ['admin', 'adopter'])) {
            return response()->json(['message' => 'Acesso restrito a adotantes e administradores'], 403);
        }

        return $next($request);
    }
}