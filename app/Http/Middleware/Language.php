<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        if (auth()->check()) {
            app()->setLocale(auth()->user()->language);
        } else {
            app()->setLocale($request->locale);
        }

        return $next($request);
    }
}
