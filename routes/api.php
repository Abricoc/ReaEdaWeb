<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

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
    if(count($cart) > 0){
        if($product->place->id != \App\Models\Product::findorfail($cart[0]['product']['id'])->place->id){
            $cart = [];
        }
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
        'CurrentCount' => $currentCount,
        'Place' => \App\Models\Product::findorfail($cart[0]['product']['id'])->place->id
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
    if(count($newCart) == 0)
        $request->user()->cart = null;
    else
        $request->user()->cart = $newCart;
    $request->user()->save();
    $place = 0;
    if(count($newCart) > 0){
        $place = \App\Models\Product::findorfail($newCart[0]['product']['id'])->place->id;
    }
    return response([
        'Items' => $cart,
        'TotalNumber' => $countAllItems,
        'FinalAmount' => $FinalAmount,
        'CurrentCount' => $currentCount,
        'Place' => $product->place->id
    ], 200);
});

Route::middleware('auth:sanctum')->get('/cart', function(Request $request){
    $cart = $request->user()->cart;
    $place = 0;
    if(count($cart) > 0)
        $place = \App\Models\Product::findorfail($cart[0]['product']['id'])->place->id;
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
        'CurrentCount' => 0,
        'Place' => $place
    ], 200);
});

Route::middleware('auth:sanctum')->post('/clearCart', function(Request $request){
    $request->user()->cart = null;
    $request->user()->save();
    return response([
        'Items' => $request->user()->cart,
        'TotalNumber' => 0,
        'FinalAmount' => 0,
        'CurrentCount' => 0,
        'Place'=> 0
    ], 200);
});

Route::post('/resetPassword', function (Request $request){
   $user =  User::where('email', $request->input('email'))->get();
   $newPassword = \Illuminate\Support\Str::random(8);
   $user->password = bcrypt($newPassword);
   $user->save();
    \Illuminate\Support\Facades\Mail::to('n.s.mitasov@mpt.ru')->send(new \App\Mail\ResetPasswords($newPassword));
});
