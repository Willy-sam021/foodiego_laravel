<?php

namespace App\Providers;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;


class RateLimiterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        RateLimiter::for('login', function (Request $request) {
            return [
                Limit::perMinute(6)
                   ->by($request->user()?->id ?: $request->ip())
                   ->response(function () {
                    return response('Too many verification attempts. Try again later.', 429);
                   })
                ];
             });

        RateLimiter::for('password-reset', function (Request $request) {
            return [
                    Limit::perMinute(3)->by($request->ip()),
                ];
            });

        /**
         * 🔹 Email verification link attempts
         * 6 attempts per minute per user+IP
         */
        RateLimiter::for('verify-email', function (Request $request) {
            return [
                Limit::perMinute(6)->by(
                    $request->user()?->id ?: $request->ip()
                ),
            ];

        });












    }


}
