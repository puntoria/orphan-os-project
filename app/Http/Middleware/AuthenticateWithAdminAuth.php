<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateWithAdminAuth
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
        if ( ! ( auth()->user()->isAdmin() || auth()->user()->isView() ) ) {
            return redirect()->to('dashboard');
        }

        return $next($request);
    }
}
