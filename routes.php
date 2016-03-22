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
Route::post('test','Api\test@GetParam');
// Setting API
Route::get('/setting-infomation','Api\GetSettingInfomation@getClippedsInfomation');

// Login API
Route::post('login','Api\LoginApi@checkLogin');

// Like API
Route::get('like-media','Api\LikeApi@likeMedia');
Route::post('like-test','Api\LikeApi@testLike');


// Favourite API
Route::post('favourite-test','Api\FavouriteApi@setTestFavouriteRestaurantForUser');

Route::post('insert-favourite-restaurant','Api\FavouriteApi@setTestFavouriteRestaurantForUser');
Route::post('remove-favourite-restaurant','Api\FavouriteApi@removeFavouriteRestaurant');
Route::post('check-favourite-restaurant','Api\FavouriteApi@checkFavouriteRestaurantExistOrNot');
Route::post('clippeds-from-token','Api\FavouriteApi@getFavouriteRestaurantFromToken' );

Route::get('client', function() {

    return 1;
});







