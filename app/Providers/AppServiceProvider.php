<?php

namespace App\Providers;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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
        Paginator::useBootstrapFive();
        \Illuminate\Support\Facades\View::composer('trangsuc.layout', function ($view) {
            if (!\Illuminate\Support\Facades\View::shared('categories')) {
                $categories = \App\Models\Type_product::all();
                $view->with('categories', $categories);
            }
        });

        \Illuminate\Support\Facades\View::composer('banhang.layout.header', function ($view) {
            $loai_sp = \App\Models\Type_product::all();
            $view->with('loai_sp', $loai_sp);
        });

        \Illuminate\Support\Facades\View::composer(['banhang.layout.header', 'banhang.checkout', 'banhang.shopping_cart'], function ($view) {
            if (\Illuminate\Support\Facades\Session::has('cart')) {
                $oldCart = \Illuminate\Support\Facades\Session::get('cart'); //session cart được tạo trong method addToCart của PageController
                $cart = new \App\Models\Cart($oldCart);
                $view->with(['cart' => \Illuminate\Support\Facades\Session::get('cart'), 'productCarts' => $cart->items, 'totalPrice' => $cart->totalPrice, 'totalQty' => $cart->totalQty]);
            }
        });
    }
}
