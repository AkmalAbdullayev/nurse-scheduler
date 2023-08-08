<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @param string|null ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                if (\auth()->user()->roles->first()->name == 'Admin') {
                    return redirect(RouteServiceProvider::HOME);
                } else if (\auth()->user()->roles->first()->name == 'Full Time Float Nurse' || \auth()->user()->roles->first()->name == 'Float Nurse') {
                    return redirect()->route('float-nurse.call-out.index');
                } else {
                    return redirect()->route('school-nurse.call-out.index');
                }
            }
        }

        return $next($request);
    }
}
