<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App\ProductType;
use Session;
use Cart;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    // public function boot()
    // {
    //     // Schema:defaultStringLength(191);
    //     //share - view chia sẻ //truyền thông tin của giỏ hàng đi và in ra sản phẩm
    //     view()->composer('header', function ($view) {
    //         $a_count = (Cart::count());
    //         $b_price = (Cart::total());
    //         $loai_sp = ProductType::all();
    //         $view->with(['loaisanpham'=>$loai_sp,'a_count'=>$a_count,'b_price'=>$b_price]);
    //     });
    // }
    // /**
    //  * Register any application services.
    //  *
    //  * @return void
    //  */
    // public function register()
    // {
    //     //
    // }
    public function boot(UrlGenerator $url)
    {
        if(env('REDIRECT_HTTPS')) {
            $url->formatScheme('https');
        }
        
        view()->composer('header', function ($view) {
            $a_count = (Cart::count());
            $b_price = (Cart::total());
            $loai_sp = ProductType::all();
            $view->with(['loaisanpham'=>$loai_sp,'a_count'=>$a_count,'b_price'=>$b_price]);
        });
    }
 
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if(env('REDIRECT_HTTPS')) {
            $this->app['request']->server->set('HTTPS', true);
        }
    }
}
