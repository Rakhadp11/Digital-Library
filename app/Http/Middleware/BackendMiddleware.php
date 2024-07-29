<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role == '1') {
            return $next($request);
        } else {
            return redirect('/admin/login')->with('message', 'Access Denied as you are not Admin!');
        }
    }
}
