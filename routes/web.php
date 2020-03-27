<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('auth')->group(function(){
    //Place routing
    Route::get('/places', 'PlaceController@index')->name('Places');
    Route::get('/places/create', 'PlaceController@create')->name('CreatePlace');
    Route::post('/places/create', 'PlaceController@store');
    Route::get('/places/{id}', 'PlaceController@show');
    Route::delete('/places/{id}', 'PlaceController@destroy');
    Route::get('/places/edit/{id}', 'PlaceController@edit');
    Route::put('/places/edit/{id}', 'PlaceController@update');
//Place end routing

//Category routing
    Route::get('/categorys', 'CategoryController@index')->name('Categorys');
    Route::get('/categorys/create', 'CategoryController@create')->name('CreateCategory');
    Route::post('/categorys/create', 'CategoryController@store');
    Route::get('/categorys/{id}', 'CategoryController@show');
    Route::delete('/categorys/{id}', 'CategoryController@destroy');
    Route::get('/categorys/edit/{id}', 'CategoryController@edit');
    Route::put('/categorys/edit/{id}', 'CategoryController@update');
//Category end routing

//Product routing
    Route::get('/products', 'ProductController@index')->name('Products');
    Route::get('/products/create', 'ProductController@create')->name('CreateProduct');
    Route::post('/products/create', 'ProductController@store');
    Route::get('/products/{id}', 'ProductController@show');
    Route::delete('/products/{id}', 'ProductController@destroy');
    Route::get('/products/edit/{id}', 'ProductController@edit');
    Route::put('/products/edit/{id}', 'ProductController@update');
//Product end routing
});
