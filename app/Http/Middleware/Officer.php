<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Officer
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
        if (Auth::user() && Auth::user()->user_type == 'OFFICER')  {
            return $next($request);
        }

        return redirect('/');
    }
}
