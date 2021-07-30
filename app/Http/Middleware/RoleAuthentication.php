<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;
use Auth;

class RoleAuthentication
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(strpos($role, Auth::user()->user_role->roles->role_name) !== false)
        {
            return $next($request);
        }
        return redirect()->route('home');
        
    }
}
