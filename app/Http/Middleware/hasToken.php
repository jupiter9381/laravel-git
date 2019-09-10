<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class hasToken
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
        if(Auth::user()->github_token == "")
          return redirect('profile')->with('error', "You must set github token first.");
        return $next($request);
    }
}
