<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTheme
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if there's a 'theme' key in the session
        if (session()->has('theme')) {
            // Share the 'theme' value with all views
            \View::share('theme', session('theme'));
        } else {
            // Default theme is 'light'
            \View::share('theme', 'light');
        }

        return $next($request);
    }
}
