<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;
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
        view()->composer(['frontend.includes.header','frontend.pages.shop-product','frontend.includes.cart'],function($view){
            $view->with('categories',Category::all());
            $view->with('cartCollections',Cart::getContent());
        });
    }
}
