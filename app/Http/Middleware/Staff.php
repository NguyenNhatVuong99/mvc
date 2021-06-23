<?php

namespace App\Http\Middleware;

use Closure;

class Staff
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
        if($request->user()->hasRole('Nhân viên bán hàng')||$request->user()->hasRole('Nhân viên giữ xe')){
            return $next($request);
        }
        else{
            
            return view('errors.400');
        }
    }
}
