<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class checkParam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $param = $request->route('poo');
        if(now()->addSeconds(10)){
            dd('oh');
        }else{
            dd('dd');
        }


        // $param = $request->route('param');
        // $cachedParam = Cache::get('param', null);
        // if ($cachedParam && $param === $cachedParam) {
        //     return $next($request);
        // }
        // Cache::put('param', $param, now()->addSeconds(20));
        // return $next($request);



    }
}
