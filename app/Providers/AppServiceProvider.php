<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\ShopConfig;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $categories = Category::all();
        View::share('categories', $categories);

        $shop = ShopConfig::orderBy('created_at', 'desc')->first() ?? null;
        View::share('shop', $shop);
        
        Paginator::useBootstrapFive();
    }
}
