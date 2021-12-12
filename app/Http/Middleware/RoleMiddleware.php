<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if( ! auth()->user()->checkRole($role) )
        // abort(403);
        return app('\App\Http\Controllers\Api\APIBaseController')->sendError('Unauthorized', 403);

        return $next($request);
    }
}
