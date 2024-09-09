<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roleIds
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$roleIds)
    {
        // Check if the user is authenticated and has one of the specified roles
        if (!$request->user() || !$request->user()->roles()->whereIn('roles.id', $roleIds)->exists()) {
            // Redirect or show an error if the user does not have the correct role
            return redirect('/dashboard')->with('error', 'You do not have access to this page.');
        }

        return $next($request);
    }
}
