<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[
    'as' => 'login.create',
    'uses' => 'SessionsController@create'
]);
Route::post('/',[
    'as' => 'login.store',
    'uses' => 'SessionsController@store'
]);
Route::get('/logout',[
   'as' => 'login.destroy',
   'uses'=> 'SessionsController@destroy'
]);



Route::get('/make',[
    'as' => 'coupon.mView',
    'uses' => 'CouponController@makeView'
]);
Route::post('/make', [
    'as' => 'coupon.make',
    'uses' => 'CouponController@makeCoupon'
]);


Route::get('/use', [
    'as' => 'coupon.useview',
    'uses' => 'CouponController@useView'
]);
Route::post('/use', [
    'as' => 'coupon.use',
    'uses' => 'CouponController@useCoupon'
]);

Route::get('/list',[
    'as' => 'list.cView',
    'uses' => 'CouponListController@listView'
]);
