<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function AddProductToCart(Request $request){
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
            if(\App\Models\Product::findorfail($request->input('productId'))->place->id != \App\Models\Product::findorfail($cart[0]['product']['id'])->place->id){
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
            'Place' => \App\Models\Product::findorfail($request->input('productId'))->place->id
        ], 200);
    }

    public function DeleteProductFromCart(Request $request){
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
            'Items' => $newCart,
            'TotalNumber' => $countAllItems,
            'FinalAmount' => $FinalAmount,
            'CurrentCount' => $currentCount,
            'Place' => $product->place->id
        ], 200);
    }

    public function GetCart(Request $request){
        $place = 0;
        $cart = $request->user()->cart;
        if (is_null($cart)) {
            $cart = [];
        }
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
    }

    public function ClearCart(Request $request){
        $request->user()->cart = null;
        $request->user()->save();
        return response([
            'Items' => $request->user()->cart,
            'TotalNumber' => 0,
            'FinalAmount' => 0,
            'CurrentCount' => 0,
            'Place'=> 0
        ], 200);
    }
}
