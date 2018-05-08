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
            if(Auth::guard($guard)->user()->is_block == '1')
            {
                \Auth::guard('agency')->logout();
                \Session::flash('error','Your are blocked by Goweeks, if you have any concern,Please call us or drop a mail to goweeeks. Contact and support: Email - team@goweeks.in Phone - 9582835523');
                return redirect('agency');
            }         
        }
        return $response;
    }
}
