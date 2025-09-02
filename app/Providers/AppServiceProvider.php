<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Category;


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
        View::composer('shop', function ($view) {
            $brands = Product::select('brand')->distinct()->orderBy('brand')->pluck('brand');
            $categories = Category::all();
            $view->with([
                'brands' => $brands,
                'categories' => $categories,
            ]);
        });
    }
}
