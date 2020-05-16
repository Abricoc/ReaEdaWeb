@extends('layouts.app_layout')

@section('title', $Model->name_product)

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="panel panel-white">
        <div class="panel-body">
            <form>
                <div class="form-group">
                    <label for="name_product">Наименование продукта:</label>
                    <input id="name_product" readonly required class="form-control" type="text" name="name_product" value="{{ $Model->name_product }}">
                </div>
                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input id="price" readonly class="form-control" required type="number" min="0" name="price" value="{{ $Model->price }}">
                </div>
                <div class="form-group">
                    <label for="text">Описание:</label>
                    <div>
                        {{ $Model->text }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="category_id">Категория:</label>
                    <input type="text" class="form-control" value="{{ $Model->category->category_name }}" name="category_id" id="category_id" readonly>
                </div>
                <div class="form-group">
                    <label for="place_id">Столовая:</label>
                    <input type="text" class="form-control" value="{{ $Model->place->place_name }}" name="category_id" id="category_id" readonly>
                </div>
                <div class="form-group">
                    <label>Блюдо дня:</label>
                    <input onclick="return false;" type="checkbox" @if($Model->dish_of_the_day == 1) checked  @endif">
                </div>
                <div class="form-group">
                    <label for="photo">Фотография:</label><br>
                    <img width="500px" src="{{ $Model->photo }}" alt="{{ $Model->product_name }}">
                </div>
                <a href="/products" class="btn btn-primary m-b-sm">Назад</a>
            </form>
        </div>
    </div>
@endsection
