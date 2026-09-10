<?php

namespace App\Providers;

use App\Models\Order;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['layouts.layout', 'home', 'orders.cart'], function ($view) {
            $cartCount = Order::whereNull('paid_at')->count();

            $view->with('cartCount', $cartCount);
        });
    }
}
