<?php

namespace App\Http\Middleware;

use Closure;

class Agency
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
      if(!\Auth::guard($guard)->check()) 
      {
         return redirect('agency');
      }
      return $next($request);
    }
}
