<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        if(\Illuminate\Support\Facades\Request::is('api/*'))
            return Product::with('category')->with('place')->get();
        return view('Product.index', [
            'Products' => Product::paginate(5)
        ]);
    }

    public function create(){
        return view('Product.create');
    }

    public function store(Request $request){
        $request->validate([
            'name_product' => 'required|max:30',
            'price' => 'required',
            'text' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif',
            'category_id ' => 'required',
            'place_id ' => 'required'
        ],[
            'name_product.required' => 'Наименование продукта является обязательным полем',
            'name_product.max' => 'В наименовании продукта должно быть не больше 30 символов',
            'price.required' => 'Цена является обязательным полем',
            'text.required' => 'Описание является обязательным полем'
        ]);

        return redirect('/products');
    }
}
