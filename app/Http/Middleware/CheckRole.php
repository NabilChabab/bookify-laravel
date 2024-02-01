<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (Auth::check()) {
            if ($request->user()->role->name === $role) {
                return $next($request);
            }
        }

        // Redirect to login with an error message for unauthorized access
        return redirect('/login')->with('error', 'Unauthorized access');
    }
}
