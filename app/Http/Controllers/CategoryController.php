<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CategoryController extends Controller
{
    public function index()
    {
        if(\Illuminate\Support\Facades\Request::is('api/*'))
            return Category::all();
        return view('category.index', [
            'Categorys' => Category::all()
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:categorys|max:70'
        ], [
            'category_name.required' => 'Название категории, является обязательным полем',
            'category_name.unique' => 'Категория с таким названием уже существует',
            'category_name.max' => 'Название категории не может быть больше 70 символов'
        ]);
        $Category = Category::create($request->all());
        return redirect('/categorys');
    }

    public function show($id)
    {
        if(\Illuminate\Support\Facades\Request::is('api/*'))
            return Category::findorfail($id);
        return view('category.show', [
            'Model' => Category::findorfail($id)
        ]);
    }

    public function edit($id)
    {
        return view('category.edit',[
            'Model' => Category::findorfail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $Model = Category::findorfail($id);
        $request->validate([
            'category_name' => 'required|unique:categorys,category_name,' . $id . '|max:70'
        ], [
            'category_name.required' => 'Название категории, является обязательным полем',
            'category_name.max' => 'Название категории не может быть больше 70 символов',
            'category_name.unique' => 'Категория с таким названием уже существует',
        ]);
        $Model->category_name = $request->input('category_name');
        $Model->save();
        return redirect('/categorys');
    }

    public function destroy($id)
    {
        Category::destroy($id);
        return redirect('/categorys');
    }
}
