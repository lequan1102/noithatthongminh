<?php

namespace App\Providers;
//Fields
use App\Categories;
use App\Carts;
use Cart, Auth;
use TCG\Voyager\Facades\Voyager;
use App\FormFields\CkeditorFormField;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{

    public function register()
    {

        Voyager::addFormField(CkeditorFormField::class);
    }

    public function boot()
    {
        View::composer('*', function ($view) {
            $data = Categories::orderBy('order','DESC')->limit(30)->get();


            //In ra số lượng giỏ hàng của người dùng
            if (Auth::guard('customer')->check()){
                $totalCartByUser = \DB::table('carts')->where('customer_id',Auth::guard('customer')->user()->id)->first();
            } else {
                Cart::getContent()->count();
            }
            
            $view->with('category', $data);
        });
    }
}
