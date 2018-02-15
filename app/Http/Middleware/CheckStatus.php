<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'agency')
    {
        $response = $next($request);
        //If the status is not approved redirect to login 
        if(Auth::guard($guard)->check() ){
            if(Auth::guard($guard)->user()->status == 0)
            {
                return redirect()->route('agency.pending');
            }
            else if(Auth::guard($guard)->user()->status ==2)
            {
                return redirect()->route('view-profile');
            }            
        }
        return $response;
    }
}
