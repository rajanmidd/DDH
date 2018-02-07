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
      $response= $next($request);

      return $response->header("Cache-Control","no-cache,no-store, max-age=0, must-revalidate")
                      ->header("Pragma", "no-cache")
                      ->header("Expires"," Sat, 01 Jan 1990 05:00:00 GMT");
    }
}
