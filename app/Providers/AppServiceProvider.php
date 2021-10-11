<?php

namespace App\Providers;
use App\Brand;
use App\Category;
use App\Cart;
use Illuminate\Support\ServiceProvider;

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
        view()->composer('home_layout', function($view){
        $cate_product=Category::orderBy('id','desc')->get();
        $brand_product=Brand::orderBy('id','desc')->get();
        $cart = Cart::all();
        $view->with(compact('brand_product','cate_product','cart'));
        });
    }
}
