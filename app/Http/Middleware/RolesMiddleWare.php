<?php

namespace App\Http\Middleware;
use Auth;
use Closure;
use Illuminate\Http\Request;

class RolesMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd($user);
        // if(auth()->guard('admin')->check()){
            // dd(auth()->guard('admin'));
            return $next($request);
        // }
        // dd(auth()->user());
        // return redirect()->back();
    }
}
