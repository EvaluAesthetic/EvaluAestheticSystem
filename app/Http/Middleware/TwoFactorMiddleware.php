<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorMiddleware
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
        $user = auth()->user();

        // Check if the user is authenticated
        if ($user) {
            // Check if a verification code exists in the cache for the user
            $verificationCode = Cache::get('2fa_code_' . $user->id);

            // If the code exists, redirect to the 2FA verification page
            if ($verificationCode) {
                return redirect()->route('2fa.verify');
            }
        }

        return $next($request);
    }
}
