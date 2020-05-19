<?php

namespace App\Http\Middleware;

use App\Model\Shop;

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
        $subdomains = array_slice($adomain, 0, count($adomain) == 2 ? -1 : -2);
        $shop = Shop::where('name', $subdomains[0])->first();
        if ($shop != null) {
            $request->merge(['middlewareShop' => $shop]);
            return $next($request);
        }
        abort(404);
    }
}
