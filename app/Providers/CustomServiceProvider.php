<?php

namespace App\Providers;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\ServiceProvider;
use App\Models\Cart;
class CustomServiceProvider extends ServiceProvider
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
    View::composer('*', function ($view) {
        if (Auth::check()) {
            $userId = Auth::id();

            // Count of items in the cart
            $cartCount = Cart::where('user_id', $userId)->count();

            // Dynamically calculate total price from cart items
            $total_price = Cart::where('user_id', $userId)
                ->with('product') // eager load product to avoid N+1 problem
                ->get()
                ->sum(function ($cart) {
                    return $cart->quantity * $cart->product->price_per_kg;
                });

        } else {
            $cartCount = 0;
            $total_price = 0;
        }

        // Share data with all views
        $view->with([
            'cartCount' => $cartCount,
            'total_price' => $total_price
        ]);
    });
}

}
