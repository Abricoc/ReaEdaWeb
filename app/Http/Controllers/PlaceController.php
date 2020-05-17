<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class PlaceController extends Controller
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
        $newFileName = self::getRandomFileName(public_path() . '/images/places', $request->file('place_photo')->getClientOriginalExtension());
        $request->file('place_photo')->move(public_path()  . '/images/places/', $newFileName);
        $place->place_photo = '/images/places/' . $newFileName;
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
            $newFileName = self::getRandomFileName(public_path() . '/images/places', $request->file('place_photo')->getClientOriginalExtension());
            $request->file('place_photo')->move(public_path()  . '/images/places/', $newFileName);
            $Model->place_photo = '/images/places/' . $newFileName;
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
