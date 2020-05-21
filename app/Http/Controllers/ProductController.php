<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public static function getRandomFileName($path, $extension='')
    {
        $extension = $extension ? '.' . $extension : '';
        $path = $path ? $path . '/' : '';
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name . $extension;
        } while (file_exists($file));
        return $name . $extension;
    }

    public function index()
    {
        if(\Illuminate\Support\Facades\Request::is('api/*'))
            return Product::with(['category', 'place'])->get();
        return view('product.index', [
            'Products' => Product::all()
        ]);
    }

    public function create(){
        return view('product.create');
    }

    public function store(Request $request){
        $request->validate([
            'name_product' => 'required|max:30',
            'price' => 'required',
            'text' => 'required',
            'photo' => 'required|mimes:jpeg,jpg,png,gif',
            'category_id' => 'required',
            'place_id' => 'required',
        ],[
            'name_product.required' => 'Наименование продукта является обязательным полем',
            'name_product.max' => 'В наименовании продукта должно быть не больше 30 символов',
            'price.required' => 'Цена является обязательным полем',
            'text.required' => 'Описание является обязательным полем'
        ]);
        $product = new Product;
        $product->name_product = $request->input('name_product');
        $product->price = $request->input('price');
        $product->text = $request->input('text');
        $product->category_id = $request->input('category_id');
        $product->place_id = $request->input('place_id');
        if($request->input('day_check') == 'on')
            $product->dish_of_the_day = true;
        else
            $product->dish_of_the_day = false;

        $newFileName = self::getRandomFileName(public_path() . '/images/products', $request->file('photo')->getClientOriginalExtension());
        $request->file('photo')->move(public_path()  . '/images/products/', $newFileName);
        $product->photo = '/images/products/' . $newFileName;
        $product->save();
        return redirect('/products');
    }

    public function show($id){
        return view('product.show', [
            'Model' => Product::findorfail($id)
        ]);
    }

    public function edit($id){
        return view('product.edit', [
           'Model' => Product::findorfail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_product' => 'required|max:30',
            'price' => 'required',
            'text' => 'required',
            'photo' => 'mimes:jpeg,jpg,png,gif',
            'category_id' => 'required',
            'place_id' => 'required'
        ], [
            'name_product.required' => 'Наименование продукта является обязательным полем',
            'name_product.max' => 'В наименовании продукта должно быть не больше 30 символов',
            'price.required' => 'Цена является обязательным полем',
            'text.required' => 'Описание является обязательным полем'
        ]);
        $product = Product::findorfail($id);
        $product->name_product = $request->input('name_product');
        $product->price = $request->input('price');
        $product->text = $request->input('text');
        $product->category_id = $request->input('category_id');
        $product->place_id = $request->input('place_id');
        if ($request->input('day_check') == 'on')
            $product->dish_of_the_day = true;
        else
            $product->dish_of_the_day = false;
        if ($request->hasFile('photo'))
        {
            $newFileName = self::getRandomFileName(public_path() . '/images/products', $request->file('photo')->getClientOriginalExtension());
            $request->file('photo')->move(public_path()  . '/images/products/', $newFileName);
            $product->photo = '/images/products/' . $newFileName;
        }
        $product->save();
        return redirect('/products');
    }

    public function destroy($id){
        Product::destroy($id);
        return redirect('/products');
    }

}
