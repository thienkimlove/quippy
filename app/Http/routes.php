<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Login API
Route::post('login','Api\LoginApi@checkLogin');
Route::post('user-information','Api\LoginApi@getFullUserInformation');
Route::get('admin-page','Api\LoginApi@adminPage');


// Like API
Route::post('like-media','Api\LikeApi@likeMedia');

// Favourite API
Route::post('insert-favourite-restaurant','Api\FavouriteApi@setTestFavouriteRestaurantForUser');
Route::post('remove-favourite-restaurant','Api\FavouriteApi@removeFavouriteRestaurant');
Route::post('check-favourite-restaurant','Api\FavouriteApi@checkFavouriteRestaurantExistOrNot');
Route::post('clippeds-from-token','Api\FavouriteApi@getFavouriteRestaurantFromToken' );

// Setting API
Route::post('insert-setting','Api\SettingApi@updateSettingForUser');
Route::post('getting-setting','Api\SettingApi@getSettingFromUser');
Route::post('update-radius','Api\SettingApi@updateRadiusForSetting');
Route::post('get-radius','Api\SettingApi@getingRadiusFromUser');

// Notification API
Route::post('push-notification','Api\PushNotifications@pushNotifications');
Route::post('insert-device','Api\PushNotifications@setDeviceForUser');
Route::post('notifi-test','Api\PushNotifications@test');

// Media API
Route::post('insert-media','Api\MediaApi@insertMediaForUser');
Route::post('getting-media-around','Api\MediaApi@checkMediaExistOrNot');

// AdminCp
Route::resource('admin/user', 'Admin\AdminController');
Route::resource('admin/favor', 'Admin\FavorRestaurantController');
Route::get('getting-user','Admin\AdminController@getUserFromDb');


Route::get('admin/user/{id}/remove','Admin\AdminController@removeUser');
Route::get('admin/login','Admin\AdminController@login');
Route::post('admin/authenticate','Admin\AdminController@authenticate');

// Setting
Route::get('admin/user/{id}/setting','Admin\AdminController@userSetting');
Route::get('admin/user/setting/{id}/edit','Admin\AdminController@editSetting');
Route::get('admin/user/setting/{id}/submit','Admin\AdminController@submitSetting');


Route::get('admin/user/{id}/favourite','Admin\AdminController@userFavourite');
Route::get('admin/user/favour/{id}/{userid}/remove','Admin\AdminController@removeFavourite');
Route::get('test','Admin\AdminController@testt');
Route::get('client', function() {
    return view('admin.user.edit.index');
});
Route::get('update', function() {
    Schema::table('devices', function ($table) {

        $table->string('type');
    });
});









