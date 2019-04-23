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
    'uses' => 'sessionsController@create'
]);
Route::post('/',[
    'as' => 'login.store',
    'uses' => 'sessionsController@store'
]);
Route::get('/logout',[
   'as' => 'login.destroy',
   'uses'=> 'sessionsController@destroy'
]);



Route::get('/make',[
    'as' => 'coupon.mView',
    'uses' => 'couponController@makeView'
]);
Route::post('/make', [
    'as' => 'coupon.make',
    'uses' => 'couponController@makeCoupon'
]);


Route::get('/use', [
    'as' => 'coupon.useview',
    'uses' => 'couponController@useView'
]);
Route::post('/use', [
    'as' => 'coupon.use',
    'uses' => 'couponController@useCoupon'
]);

Route::get('/list',[
    'as' => 'list.cView',
    'uses' => 'couponListController@listView'
]);
