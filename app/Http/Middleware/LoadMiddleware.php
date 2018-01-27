<?php

namespace App\Http\Middleware;

use Closure;

class LoadMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,...$param)
    {
        return $next($request);
    }
}
