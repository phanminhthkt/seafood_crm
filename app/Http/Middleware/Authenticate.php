<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;
use Closure;
class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if($guard == "web" && Auth::guard($guard)->check() == false){
            return redirect()->route('admin.user.login');
        }
        if($guard == "members" && Auth::guard($guard)->check() == false){
            return redirect()->route('client.member.login');
        }
        return $next($request);
    }
    // protected function redirectTo($request, Closure $next, $guard = null)
    // {
        // if($guard == "web" && Auth::guard($guard)->check() == false){
            // return route('admin.user.login');
        // }
        // if($guard == "members" && Auth::guard($guard)->check() == false){
            // return route('client.member.login');
        // }
        // if (! $request->expectsJson()) {
        //     return route('admin.user.login');
        // }
    // }
}
