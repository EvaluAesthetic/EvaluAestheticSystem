<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class EnsureUserIsClient
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        Log::info('EnsureUserIsClient middleware called.');

        if (!Auth::check()) {
            Log::info('User not authenticated.');
            return redirect()->route('login');
        }

        $user = Auth::user();

        if ($user->roles()->where('id', 4)->exists() && $user->clients()->exists()) {
            Log::info('User is a client.');
            return $next($request);
        }

        Log::info('User is not authorized.');
        return redirect()->route('home')->with('error', 'You are not authorized to access this page.');
    }

}
