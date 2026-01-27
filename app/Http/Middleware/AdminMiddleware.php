<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || $request->user()->role !== 'admin') {
            if ($request->expectsJson() || $request->is('api/*')) {
                return response()->json(['message' => 'Apenas administradores podem acessar este recurso'], 403);
            }
            return redirect()->route('dashboard')->with('error', 'Acesso negado. Apenas administradores.');
        }

        return $next($request);
    }
}