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
    $count = 1;
    $countAllItems = 0;
    $FinalAmount = 0;
    $currentCount = 0;
    if($request->has('count')){
        $count = (int)$request->input('count');
    }
    $cart = $request->user()->cart;
    if (is_null($cart)) {
        $cart = [];
    }
    $check = true;
    for ($i = 0; $i < count($cart); $i++)
    {
        if ($product->id == $cart[$i]['product']['id']){
            $cart[$i]['count'] += $count;
            if($cart[$i]['count'] > 20) $cart[$i]['count'] = 20;
            $cart[$i]['price'] = $product->price * $cart[$i]['count'];
            $currentCount = $cart[$i]['count'];
            $check = false;
        }
        $countAllItems += $cart[$i]['count'];
        $FinalAmount += $cart[$i]['price'];
    }
    if($check){
        $cart[] = [
            'product' => $product->toArray(),
            'count'=> $count,
            'price' => $product->price * $count
        ];
        $countAllItems += $count;
        $FinalAmount += $product->price * $count;
        $currentCount = $cart[$i]['count'];
    }
    $request->user()->cart = $cart;
    $request->user()->save();
    return response([
        'Items' => $cart,
        'TotalNumber' => $countAllItems,
        'FinalAmount' => $FinalAmount,
        'CurrentCount' => $currentCount
    ], 200);
});

Route::middleware('auth:sanctum')->delete('/cart', function(Request $request){
    $product = \App\Models\Product::findorfail($request->input('productId'));
    $count = 1;
    $countAllItems = 0;
    $FinalAmount = 0;
    $currentCount = 0;
    if($request->has('count')){
        $count = (int)$request->input('count');
    }
    $cart = $request->user()->cart;
    $newCart = [];
    for ($i = 0; $i < count($cart); $i++)
    {
        if ($product->id == $cart[$i]['product']['id']){
            $cart[$i]['count'] -= $count;
            if($cart[$i]['count'] < 0) $cart[$i]['count'] = 0;
            $cart[$i]['price'] = $product->price * $cart[$i]['count'];
            $currentCount = $cart[$i]['count'];
        }
        if($cart[$i]['count'] != 0){
            $newCart[] = $cart[$i];
            $countAllItems += $cart[$i]['count'];
            $FinalAmount += $cart[$i]['price'];
        }
    }
    $request->user()->cart = $newCart;
    $request->user()->save();

    return response([
        'Items' => $cart,
        'TotalNumber' => $countAllItems,
        'FinalAmount' => $FinalAmount,
        'CurrentCount' => $currentCount
    ], 200);
});

Route::middleware('auth:sanctum')->get('/cart', function(Request $request){
    $cart = $request->user()->cart;
    $countAllItems = 0;
    $FinalAmount = 0;
    for ($i = 0; $i < count($cart); $i++)
    {
        $countAllItems += $cart[$i]['count'];
        $FinalAmount += $cart[$i]['price'];
    }
    return response([
        'Items' => $cart,
        'TotalNumber' => $countAllItems,
        'FinalAmount' => $FinalAmount,
        'CurrentCount' => 0
    ], 200);
});
