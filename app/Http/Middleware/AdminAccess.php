<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccess
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
        if (!auth('web')->check()) {
            return redirect()->route('index_page')->with('error', "User not Login");
        }
        if (auth('web')->check() && auth('web')->user()->type != 1) {
            return redirect()->route('index_page')->with('error', "You are not Authorized!!");
        }
        return $next($request);
    }
}
