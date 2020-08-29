<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['api', 'throttle:500,1'])->post('/register', 'Auth\ApiController@register');
Route::middleware(['api', 'throttle:500,1'])->post('/login', 'Auth\ApiController@token');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->get('/logout', 'Auth\ApiController@logout');
Route::middleware(['api', 'throttle:500,1'])->get('/categorys', 'CategoryController@index');
Route::middleware(['api', 'throttle:500,1'])->get('/places', 'PlaceController@index');
Route::middleware(['api', 'throttle:500,1'])->get('/places/{id}', 'PlaceController@show');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->get('/profile', 'UsersController@profile');
Route::middleware(['api', 'throttle:500,1'])->get('/singleProduct/{id}', function($id){
    return App\Models\Product::with(["category", "place"])->find($id);
});
Route::middleware(['api', 'throttle:500,1'])->get('/products/{placeId}', function($placeId){
    return [
        'products' => App\Models\Product::with(["category", "place"])->where('place_id', $placeId)->get(),
        'categorys' => \Illuminate\Support\Facades\DB::select("SELECT id, category_name FROM categorys WHERE (SELECT COUNT(*) FROM products WHERE products.place_id = $placeId AND products.category_id = categorys.id) > 0")
        ];
});
Route::middleware(['api', 'throttle:500,1'])->get('/products/{placeId}/{categoryId}', function($placeId, $categoryId){
    return App\Models\Product::with(["category", "place"])->where('place_id', $placeId)->where('category_id', $categoryId)->get();
});
Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/cart', 'CartController@AddProductToCart');

Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/changecount', 'CartController@ChangeProductCountFromCart');

Route::middleware(['auth:sanctum', 'throttle:500,1'])->delete('/cart', 'CartController@DeleteProductFromCart');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->get('/cart', "CartController@GetCart");
Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/clearCart', 'CartController@ClearCart');
Route::middleware(['api', 'throttle:500,1'])->post('/resetPassword', 'Auth\ApiController@ResetPassword');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/changeName', 'Auth\ApiController@ChangeName');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/changePassword', 'Auth\ApiController@ChangePassword');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/changeEmail', 'Auth\ApiController@ChangeEmail');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->post('/checkout', 'OrdersController@CheckOut');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->get('/profile', 'Auth\ApiController@Profile');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->get('/orders', 'OrdersController@GetMyOrders');
Route::middleware(['auth:sanctum', 'throttle:500,1'])->delete('/orders', 'OrdersController@DeclineOrder');
