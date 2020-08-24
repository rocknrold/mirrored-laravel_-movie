<?php

namespace App\Http\Middleware;

use Closure;

class UriDirectAccess
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
        $method = $request->method();

        if ($request->isMethod('get')) {
            return abort(404);
        }

        return $next($request);
    }
}
