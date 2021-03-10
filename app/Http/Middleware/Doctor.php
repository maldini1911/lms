<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use Closure;
use Auth;

class Doctor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next = null, $guard = null)
    {
        if(Auth::guard('doctor')->check())
        {
            return $next($request);
        }else{
            return redirect('login');
        }

    }
}
