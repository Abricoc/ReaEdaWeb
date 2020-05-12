<?php
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
Route::middleware('auth:sanctum')->post('/cart', 'CartController@AddProductToCart');
Route::middleware('auth:sanctum')->delete('/cart', 'CartController@DeleteProductFromCart');
Route::middleware('auth:sanctum')->get('/cart', 'CartController@GetCart');
Route::middleware('auth:sanctum')->post('/clearCart', 'CartController@ClearCart');
Route::post('/resetPassword', 'Auth\ApiController@ResetPassword');
