<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSeller
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
       if (auth()->check()) {
            // Check if the user is a seller
            if (auth()->user()->is_seller) {
                return $next($request); // allow request
            }
        }

        // If not a seller, redirect or abort
        return redirect('/')->with('error', 'Access denied.');
    }
}
