<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        view()->composer('*',function ($view){
            $product_count = Product::all()->count();
            $category_count = Category::all()->count();
            $user_count = User::all()->count();
            $order_count = Order::all()->count();
            $view->with('product_count',$product_count)->with('category_count',$category_count)->with('user_count',$user_count)->with('order_count',$order_count);
        });

    }
}
