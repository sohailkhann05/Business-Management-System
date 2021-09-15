<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'super-admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('superadmin.dashboard');
                }
                break;

            case 'business-admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('businessadmin.dashboard');
                }
                break;

            case 'branch-admin':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('branchadmin.dashboard');
                }
                break;

            case 'customer':
                if (Auth::guard($guard)->check()) {
                    return redirect()->route('myaccount');
                }
                break;

            default:
                if (Auth::guard($guard)->check()) {
                    return redirect('/');
                }
                break;
        }
        return $next($request);
    }
}
