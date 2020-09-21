<?php

/*
| --------------------------------------------------------------------------
| Các tuyến đường web         User View::
| --------------------------------------------------------------------------
|
| Đây là nơi bạn có thể đăng ký các tuyến web cho ứng dụng của bạn. Những
| tuyến đường này được tải bởi RouteServiceProvider trong một nhóm chứa
| các nhóm phần mềm trung gian "web". Bây giờ tạo ra một cái gì đó tuyệt vời!
|
*/



Route::group(['prefix' => LaravelLocalization::setLocale()], function () {
    /**********************************************
     ********* Thiết lập cho đa ngôn ngữ **********
     **********************************************/
    Route::get('locale', function () {
        return \App::getLocale();
    });
    Route::get('locale/{locale}', function ($locale) {
        Session::put('locale', $locale);
        $parts = parse_url(URL::previous());
        return redirect($locale . substr($parts['path'], 3));
    });
    /**********************************************
     ********* Thiết lập cho giao diện   **********
     **********************************************/
    Route::prefix('user')->group(function () {
        //Đã xác thực thành công
        Route::get('/', 'UserController@index')->name('index.user');
        //Address Account
        Route::group(['prefix' => 'address'], function () {
            Route::get('/', 'UserController@location')->name('location.user');
            Route::get('create', 'UserController@create_location')->name('create_location.user');
            Route::post('create', 'UserController@create_location_submit')->name('submit.create.location.user');
            Route::get('del/{id}', 'UserController@del_location')->name('del.location.user');
            Route::get('edit', 'UserController@edit_location')->name('edit.location.user');
            Route::post('edit/{id}', 'UserController@edit_submit_location')->name('edit.submit.location.user');
        });
        //Profile Account
        Route::group(['prefix' => 'profile'], function () {
            Route::get('myacount', 'UserController@profile_user')->name('profile.user');
            Route::get('manage', 'UserController@manage_user')->name('manage.user');
            Route::get('myacount/edit/{id}', 'UserController@profile_edit_user')->name('profile.edit.user');
            Route::post('myacount/edit/{id}', 'UserController@profile_edit_submit_user')->name('profile.edit.submit.user');
        });
        //Favourite Account
        Route::group(['prefix' => 'favourite'], function () {
            Route::get('/', 'UserController@favourite')->name('favourite.user');
        });
        Route::get('aboutme', 'UserController@aboutme')->name('aboutme.user');
    });
    /**Sổ địa chỉ **/
    Route::post('loadLocation', 'UserController@loadLocation')->name('loadLocation');
});
