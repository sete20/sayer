<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CompanyLang
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
        if (session()->has('company-lang')){
            App()->setLocale(session('company-lang'));
        } else {
            App()->setLocale('ar');
        }
        return $next($request);
    }
}
