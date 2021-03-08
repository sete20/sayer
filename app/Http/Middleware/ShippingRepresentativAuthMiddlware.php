<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class ShippingRepresentativAuthMiddlware
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
        $user = User::find(Auth::id());
       if(Auth::check()){
        if ($user->type == 3) {
            return $next($request);
        }
       }
       return Redirect()->route('company.login');

    }
}
