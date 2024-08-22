<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Authorizer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $requestPath = $request->path();
        $need_authorize_router = [
            'user',
            'user/reviewer',
            'user/admin',
            'user/dosen'
        ];

        $trying_to_access = array_map(function ($route) use ($requestPath) {
            if (str_starts_with($requestPath, $route)) {
                return $route;
            }
        }, $need_authorize_router);

        return Response(['trying to access' => $trying_to_access]);
        if (!Auth::check()) {
            abort(404);
        }
        return $next($request);
    }
}
