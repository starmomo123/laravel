<?php

namespace App\Http\Middleware;

use Closure;

class CheckMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->age > 23){
            return redirect('age');
        }
        return $next($request);
    }
}
