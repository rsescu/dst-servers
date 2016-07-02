<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\HttpException;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::guard($guard)->guest()) {
            $role_id = Auth::user()->role_id;
            if($role_id == 1) { //TODO remove hardcode
                return $next($request);
            }
            else {
                throw new HttpException(403);
            }
        }
        return $next($request);
    }
}
