<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use App\Models\{ Shop, Page };
use Cart;

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
        View::share('shop', Shop::firstOrFail());
        View::share('pages', Page::all());

        Route::resourceVerbs([
            'edit' => 'modification',
            'create' => 'creation',
        ]);
    
        View::composer(['layouts.app', 'products.show'], function ($view) {
            $view->with([
                'cartCount' => Cart::getTotalQuantity(), 
                'cartTotal' => Cart::getTotal(),
            ]);
        });
        
        View::composer('back.layout', function ($view) {
            $title = config('titles.' . Route::currentRouteName());
            $view->with(compact('title'));
        });
    }
}
