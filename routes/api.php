<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::middleware('api')->post('/register', 'Auth\ApiController@register');
Route::middleware('api')->post('/login', 'Auth\ApiController@token');
Route::middleware('auth:sanctum')->get('/logout', 'Auth\ApiController@logout');
Route::middleware('api')->get('/categorys', 'CategoryController@index');
Route::middleware('api')->get('/places', 'PlaceController@index');
Route::middleware('api')->get('/products', 'ProductController@index');
Route::middleware('auth:sanctum')->get('/profile', 'UsersController@profile');
