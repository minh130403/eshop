<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ShopConfig;
use App\Observers\ProductObServer;
use App\View\Components\ProductCard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
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
        $categories = Category::all() ?? null;
        View::share('categories', $categories);

        $shop = ShopConfig::orderBy('created_at', 'desc')->first() ?? null;
        View::share('shop', $shop);
        Blade::component('product-cart', ProductCard::class);


        Paginator::useBootstrapFive();

        // Product::observe(ProductObServer::class);
    }
}
