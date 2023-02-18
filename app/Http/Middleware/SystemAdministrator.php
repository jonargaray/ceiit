<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class SystemAdministrator
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
        if (Auth::user() && Auth::user()->user_type == 'SYSTEM ADMINISTRATOR') {
            return $next($request);
        }

        return redirect('/');
    }
}
