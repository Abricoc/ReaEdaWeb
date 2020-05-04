<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::middleware('api')->post('/register', 'Auth\ApiController@register');
Route::middleware('api')->post('/login', 'Auth\ApiController@token');
Route::middleware('auth:sanctum')->get('/logout', 'Auth\ApiController@logout');
Route::middleware('api')->get('/categorys', 'CategoryController@index');

Route::middleware('api')->get('/places', 'PlaceController@index');
Route::middleware('api')->get('/places/{id}', 'PlaceController@show');


Route::middleware('auth:sanctum')->get('/profile', 'UsersController@profile');

Route::middleware('api')->get('/singleProduct/{id}', function($id){
    return App\Models\Product::with(["category", "place"])->find($id);
});

Route::middleware('api')->get('/products/{placeId}', function($placeId){
    return App\Models\Product::with(["category", "place"])->where('place_id', $placeId)->get();
});

Route::middleware('api')->get('/products/{placeId}/{categoryId}', function($placeId, $categoryId){
    return App\Models\Product::with(["category", "place"])->where('place_id', $placeId)->where('category_id', $categoryId)->get();
});

Route::middleware('auth:sanctum')->post('/cart', function(Request $request){
    $product = \App\Models\Product::findorfail($request->input('productId'));
    $cart = $request->user()->cart;
    if (is_null($cart)) {
        $cart = [];
    }
    $check = true;
    for ($i = 0; $i < count($cart); $i++)
    {
        if ($product->id == $cart[$i]['product']['id']){
            $cart[$i]['count']++;
            $cart[$i]['price'] = $product->price * $cart[$i]['count'];
            $check = false;
        }
    }
    if($check){
        $cart[] = [
            'product' => $product->toArray(),
            'count'=> 1,
            'price' => $product->price * 1
        ];
    }
    $request->user()->cart = $cart;
    $request->user()->save();

    return response('ok');
});

Route::middleware('auth:sanctum')->delete('/cart', function(Request $request){
    $product = \App\Models\Product::findorfail($request->input('productId'));
    $cart = $request->user()->cart;
    $newCart = [];
    for ($i = 0; $i < count($cart); $i++)
    {
        if ($product->id == $cart[$i]['product']['id']){
            $cart[$i]['count']--;
            $cart[$i]['price'] = $product->price * $cart[$i]['count'];
        }
        if($cart[$i]['count'] != 0){
            $newCart[] = $cart[$i];
        }
    }
    $request->user()->cart = $newCart;
    $request->user()->save();

    return response('ok');
});

Route::middleware('auth:sanctum')->get('/cart', function(Request $request){
    return $request->user()->cart;
});
