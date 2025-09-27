<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;



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

        View::composer('chat.popup', function ($view) {
            $messages = collect();

            if (Auth::check() && Auth::id() != 1) {
                $messages = Message::where(function ($q) {
                    $q->where('from_id', Auth::id())->where('to_id', 1);
                })->orWhere(function ($q) {
                    $q->where('from_id', 1)->where('to_id', Auth::id());
                })->orderBy('created_at', 'asc')->get();
            }

            $view->with('messages', $messages);
        });
    }
}
