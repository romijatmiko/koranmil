<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckBabinsa
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->user() && $request->user()->role !== 'Koranmil') {
            Auth::logout(); // Logout user
            return redirect()->route('login')->with('alert', 'You are not authorized.'); // Redirect to login with alert
        }

        return $next($request);
    }
}
