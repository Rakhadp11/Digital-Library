<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendMiddleware
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
        // User = 0
        // Admin = 1
        if (Auth::check()) {

            if (Auth::user()->role == '1') {
                return $next($request);
            } else {
                return redirect('/index')->with('message', 'Access Denied as you are not Admin!');
            }
        } else {
            return redirect('/admin/dashboard')->with('message', ' Login to access the website info');
        }
        return $next($request);
    }
}
