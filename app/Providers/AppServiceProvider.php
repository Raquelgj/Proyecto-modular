<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
  use App\Models\Order;
use App\Observers\OrderObserver;



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

public function boot()
{
    // Lo que ya tienes
    View::composer('*', function ($view) {
        $view->with('categorias', Category::all());
    });
    Paginator::useBootstrap();

    // Registra el observer para Order
    Order::observe(OrderObserver::class);
}

}
