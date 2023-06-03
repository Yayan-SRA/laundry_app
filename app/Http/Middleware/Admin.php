<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role->name === 'Admin') {
            return $next($request);
        } elseif (auth()->check() && auth()->user()->role->name === 'Super Admin') {
            // return Redirect::back();
            return redirect('/dashboard/super');
        }
        return redirect('/login');
        // abort(403);
        // return Redirect::back();
    }
}
