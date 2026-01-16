<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProtectorMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! in_array($request->user()->role, ['admin', 'protector'])) {
            return response()->json(['message' => 'Acesso restrito a protetores e administradores'], 403);
        }

        return $next($request);
    }
}