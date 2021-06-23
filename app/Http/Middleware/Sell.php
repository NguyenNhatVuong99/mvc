<?php

namespace App\Http\Middleware;

use Closure;

class Sell
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
        if($request->user()->hasRole('Admin') || $request->user()->hasRole('Thu ngân')){
            return $next($request);
        }
        else{
            request()->session()->flash('error','You do not have any permission to access this page');
            return redirect()->route($request->user()->role);
        }
    }
}
