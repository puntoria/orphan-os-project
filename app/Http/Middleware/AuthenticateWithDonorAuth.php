<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateWithDonorAuth
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
        if ( ! ( auth()->user()->isDonor() ) ) {
            return redirect()->to('dashboard');
        }

        return $next($request);
    }
}
