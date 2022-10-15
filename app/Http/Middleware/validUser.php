<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class validUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { 
        if (Session::get('user_id') == null) {
        return redirect()->route('user.login.show');
        }
        return $next($request);
    }
}
