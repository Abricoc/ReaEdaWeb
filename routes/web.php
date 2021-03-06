<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/login');

Route::middleware('auth')->group(function(){
    //place routing
    Route::get('/places', 'PlaceController@index');
    Route::get('/places/create', 'PlaceController@create');
    Route::post('/places/create', 'PlaceController@store');
    Route::get('/places/{id}', 'PlaceController@show');
    Route::delete('/places/{id}', 'PlaceController@destroy');
    Route::get('/places/edit/{id}', 'PlaceController@edit');
    Route::put('/places/edit/{id}', 'PlaceController@update');
//place end routing

//category routing
    Route::get('/categorys', 'CategoryController@index')->name('Categorys');
    Route::get('/categorys/create', 'CategoryController@create')->name('CreateCategory');
    Route::post('/categorys/create', 'CategoryController@store');
    Route::get('/categorys/{id}', 'CategoryController@show');
    Route::delete('/categorys/{id}', 'CategoryController@destroy');
    Route::get('/categorys/edit/{id}', 'CategoryController@edit');
    Route::put('/categorys/edit/{id}', 'CategoryController@update');
//category end routing

//product routing
    Route::get('/products', 'ProductController@index')->name('Products');
    Route::get('/products/create', 'ProductController@create')->name('CreateProduct');
    Route::post('/products/create', 'ProductController@store');
    Route::get('/products/{id}', 'ProductController@show');
    Route::delete('/products/{id}', 'ProductController@destroy');
    Route::get('/products/edit/{id}', 'ProductController@edit');
    Route::put('/products/edit/{id}', 'ProductController@update');
//product end routing

//orders routing
    Route::get('/orders', 'OrdersController@Orders');
    Route::get('/completeOrders', 'OrdersController@CompleteOrders');
    Route::post('/changeStatus', 'OrdersController@ChangeStatus');
    Route::get('/orders/{id}', 'OrdersController@show');
    Route::post('/hasUpdate', 'OrdersController@hasUpdate');
    Route::post('/export', 'OrdersController@ExportToExcel');
//product end routing
});

Route::get('/success', 'AcquiringController@success');
Route::get('/fail', 'AcquiringController@fail');
