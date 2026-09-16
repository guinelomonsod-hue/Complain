<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $userRole = auth ('api')->payload()->get('role');

        if(!in_array($userRole, $roles)) {
            return response()->json(['error' => 'Forbidden user  blahhblahh.'], 403);
        }
        return $next($request);
    }
}
