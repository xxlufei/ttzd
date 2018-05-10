<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::group(['namespace' => 'H5'], function(){
    Route::get('/', 'OrderController@goodsList')->middleware('wechatOauth');
    //Route::get('/machine/redirect', );
    Route::get('/goods_list', 'OrderController@goodsList')->middleware('wechatOauth');
    Route::get('/order_submit', 'OrderController@orderSubmit')->middleware('wechatOauth');
    Route::get('/order_book', 'OrderController@book')->middleware('wechatOauth');
    Route::get('/order_cancel', 'OrderController@orderCancel')->middleware('wechatOauth');
    Route::get('/order_pay', 'OrderController@orderPay')->middleware('wechatOauth');
    Route::get('/order_notify', 'OrderController@notify');//->middleware('wechatOauth');
    Route::get('/order_getWxPayInfo', 'OrderController@getWxPayInfo')->middleware('wechatOauth');
});
Route::group(['namespace' => 'Pub'], function(){
    Route::get('/wechat', 'WechatController@index');
    Route::get('/oauth', 'WechatController@oauth');
    Route::get('/oauth_callback', 'WechatController@oauth_callback');
    Route::get('/code', 'RedirectController@redirectToList');//->middleware('wechatOauth');
    Route::get('/pushMsg', 'WechatController@pushMsg');//->middleware('wechatOauth');
});
Route::group(['namespace' => 'Admin'], function(){
    Route::get('/ad/category', 'CategoryController@cateList')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/submitCategory', 'CategoryController@submit')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/goods', 'GoodsController@glist')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/submitGoods', 'GoodsController@submit')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/machine', 'MachineController@mlist')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/submitMachine', 'MachineController@submit')->middleware('wechatOauth', 'adminCheck');
    Route::post('/ad/goodspicup', 'GoodsController@goodsPicUp')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/remove', 'GoodsController@remove')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/orderlist', 'OrderController@orderList')->middleware('wechatOauth', 'adminCheck');
    Route::get('/ad/orderdetail', 'OrderController@orderDetail')->middleware('wechatOauth', 'adminCheck');
});

