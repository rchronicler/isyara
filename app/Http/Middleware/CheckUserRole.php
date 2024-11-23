<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // true if user is authenticated and role is 'volunteer'
        if (!auth()->check() || auth()->user()->role !== 'volunteer') {
            return response('Unauthorized', 401);
        }
        return $next($request);
    }
}
