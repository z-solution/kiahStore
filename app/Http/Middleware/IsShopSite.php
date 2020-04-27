<?php

namespace App\Http\Middleware;

use Closure;

class IsShopSite
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
        $adomain = explode('.', $domain);
        $subdomains = array_slice($adomain, 0, count($adomain) - 2 );
        return $next($request);
    }
}
