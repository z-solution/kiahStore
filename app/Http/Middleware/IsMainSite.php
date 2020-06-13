<?php

namespace App\Http\Middleware;

use Closure;

class IsMainSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $domain = $request->getHttpHost();
        if ($domain == config('app.domain') || $domain == 'www.' . config('app.domain')) {
            return $next($request);
        }
    }
}
