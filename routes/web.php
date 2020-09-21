<?php

/*
| --------------------------------------------------------------------------
| Các tuyến đường web           Frontend  view::
| --------------------------------------------------------------------------
|
| Đây là nơi bạn có thể đăng ký các tuyến web cho ứng dụng của bạn. Những
| tuyến đường này được tải bởi RouteServiceProvider trong một nhóm chứa
| các nhóm phần mềm trung gian "web". Bây giờ tạo ra một cái gì đó tuyệt vời!
|
*/

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{
    /**********************************************
     ********* Thiết lập cho đa ngôn ngữ **********
     **********************************************/
    Route::get('locale', function () {
        return \App::getLocale();
    });
    Route::get('locale/{locale}', function ($locale) {
        Session::put('locale', $locale);
        $parts = parse_url(URL::previous());
        return redirect($locale.substr($parts['path'],3));
    });
    /**********************************************
     ********* Thiết lập đăng nhập user  **********
     **********************************************/
    Route::get('login', 'LoginUserController@signin')->name('login');
    Route::post('login', 'LoginUserController@login_submit')->name('login.submit');
    Route::get('signup', 'LoginUserController@signup')->name('login.signup');
    Route::post('signup', 'LoginUserController@signup_submit')->name('login.signup.submit');

    Route::post('logout', 'LoginUserController@logout')->name('logout');
    /**********************************************
     ********* Thiết lập cho giao diện   **********
     **********************************************/
    Route::get('/', 'HomeController@index')->name('home');

    Route::get('{slug}.html', 'HomeController@page')->name('page');

    Route::get('{slug}.htm', 'HomeController@cate')->name('cate');

    Route::group(['prefix' => 'product'], function() {
        Route::post('favorite','ProductController@favorite')->name('favorite.product');
        Route::get('/','ProductController@product_category')->name('cate.product');
        Route::get('{slug}p{id}.html','ProductController@product_details')->name('article.product');
        Route::get('filter','ProductController@filter_product')->name('filter.product');
        Route::post('filter-search','ProductController@filter_search')->name('filter.search.product');
        Route::post('quickview','ProductController@quickview')->name('quickview.product');
    });

    Route::group(['prefix' => 'tin-tuc'], function() {
        Route::get('/','HomeController@cate_news')->name('cate.news');
        Route::get('{slug}n{id}.html','HomeController@article_news')->name('article.news');
    });

    /**********************************************
     *********       Cart Giỏ hàng       **********
     **********************************************/

    Route::group(['prefix' => 'cart'], function() {
        Route::get('/', 'CartController@index')->name('cart');
        //add-cart quickview
        Route::post('addcart', 'CartController@add_cart')->name('add.cart');
        Route::get('update-cart', 'CartController@update')->name('update.cart');
        Route::post('update-ajx-cart', 'CartController@updateQuantityItem')->name('update.ajx.cart');
        Route::get('remove-cart/{id}', 'CartController@remove')->name('remove.cart');
        Route::post('loadlocation', 'CartController@loadLocation')->name('load.location.cart');
        Route::post('order', 'CartController@order')->name('order.cart');
        // Route::post('orderget', 'CartController@orderget')->name('order.get.cart');
    });
    

    













    /*
     * Tìm kiếm
     * customer.waybill.code       $GET  | link người Trung quốc có thể nhập mã vận đơn
     * customer.waybill.code.post  $POST | link người Trung quốc có thể nhập mã vận đơn và thêm kho hoặc cập nhật kho
     */
});


/*
 * Route Export Excel
 *
 * ::excel download get all Order By Id Customer
 * ::excel download get all Transport By Id Customer
 * ::excel download get all Order               -- In route on Voyager 'prefix' => 'admin'
 * ::excel download get all Transport           -- In route on Voyager 'prefix' => 'admin'
 */

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
    // Route::get('/excel-order', 'ExcelController@export_order_all')->name('order.export');
    // Route::get('/excel-transport', 'ExcelController@export_transport_all')->name('transport.export');
});
