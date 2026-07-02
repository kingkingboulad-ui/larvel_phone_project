<?php

namespace App\Providers;

use App\Models\cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        Paginator::useBootstrapFive();
        View::composer('*', function ($view) {

            $cart = null;
    
            if (Auth::check()) {
                $cart = cart::with('items')
                    ->where('user_id', Auth::id())
                    ->first();
            }
    
            $view->with('cart', $cart);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
    }
}
