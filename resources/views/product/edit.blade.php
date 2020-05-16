@extends('layouts.app_layout')

@section('title', 'Изменение продукта')

@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <form enctype="multipart/form-data" action="/products/edit/{{ $Model->id }}" method="POST">
                @csrf
                {!! method_field('put') !!}
                <div class="form-group">
                    <label for="name_product">Наименование продукта:</label>
                    <input id="name_product" required class="form-control" type="text" name="name_product" value="{{ $Model->name_product }}">
                </div>
                @error('name_product')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input id="price" class="form-control" required type="number" min="0" name="price" value="{{ $Model->price }}">
                </div>
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="price">Описание:</label>
                    <textarea class="form-control" required name="text" id="text" cols="30" rows="10">{{ $Model->text }}</textarea>
                </div>
                @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="category_id">Категория:</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach(App\Models\Category::all() as $Category)
                            <option @if($Model->category->id == $Category->id) selected @endif value="{{ $Category->id }}">{{ $Category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="place_id">Столовая:</label>
                    <select class="form-control" name="place_id" id="place_id">
                        @foreach(App\Models\Place::all() as $Place)
                            <option @if($Model->place->id == $Place->id) selected @endif value="{{ $Place->id }}">{{ $Place->place_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('place_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="place_id">Блюдо дня:</label>
                    <input name="day_check" @if($Model->dish_of_the_day == 1) checked  @endif" type="checkbox">
                </div>

                <div class="form-group">
                    <label for="photo">Фотография:</label>
                    <input id="photo" accept="image/*" required class="form-control" type="file" name="photo">
                </div>
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success m-b-sm">Изменить</button>
            </form>
        </div>
    </div>
@endsection
