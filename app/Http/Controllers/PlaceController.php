<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Http\Requests\StorePlace;

class PlaceController extends Controller
{
    public function index()
    {
        if(\Illuminate\Support\Facades\Request::is('api/*'))
            return Place::all();
        return view('place.index', [
            'Places' => Place::paginate(5)
        ]);
    }

    public function create()
    {
        return view('place.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'place_name' => 'required|unique:places|max:100',
            'place_photo' => 'required|mimes:jpeg,jpg,png,gif'
        ], [
            'place_name.required' => 'Название столовой, является обязательным полем',
            'place_name.unique' => 'Столовая с таким названием уже существует',
            'place_name.max' => 'Название столовой не может быть больше 100 символов',
            'place_photo.mimes' => 'Фотография должна иметь следующее расширение: jpeg, jpg, png, gif.',
            'place_photo.required' => 'Обязательно наличие фотографии'
        ]);
        $place = new Place;
        $place->place_name = $request->input('place_name');
        $place->place_photo = '/storage/' . $request->file('place_photo')->store('places', 'public');
        $place->save();
        return redirect('/places');
    }

    public function show($id)
    {
        if(\Illuminate\Support\Facades\Request::is('api/*'))
            return Place::findorfail($id);
        return view('place.show', [
            'Model' => Place::findorfail($id)
        ]);
    }

    public function edit($id)
    {
        return view('place.edit',[
            'Model' => Place::findorfail($id)
        ]);
    }

    public function update(Request $request, $id)
    {
        $Model = Place::findorfail($id);
        $request->validate([
            'place_name' => 'required|max:100',
            'place_photo' => 'mimes:jpeg,jpg,png,gif'
        ], [
            'place_name.required' => 'Название столовой, является обязательным полем',
            'place_name.max' => 'Название столовой не может быть больше 100 символов',
            'place_photo.mimes' => 'Фотография должна иметь следующее расширение: jpeg, jpg, png, gif.',
            'place_photo.required' => 'Обязательно наличие фотографии'
        ]);
        $Model->place_name = $request->input('place_name');
        if($request->hasFile('place_photo')){
            $path = $request->file('place_photo')->store('places', 'public');
            $Model->place_photo = $path;
        }
        $Model->save();
        return redirect('/places');
    }

    public function destroy($id)
    {
        Place::destroy($id);
        return redirect('/places');
    }
}
