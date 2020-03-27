@extends('Layouts.appLayout')

@section('title', 'Добавление нового продукта')

@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <form enctype="multipart/form-data" action="/products/create" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name_product">Наименование продукта:</label>
                    <input id="name_product" required class="form-control" type="text" name="name_product" value="{{ old('name_product') }}">
                </div>
                @error('name_product')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="price">Цена:</label>
                    <input id="price" class="form-control" required type="number" min="0" name="price" value="{{ old('price') }}">
                </div>
                @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="price">Описание:</label>
                    <textarea required name="text" id="text" cols="30" rows="10"></textarea>
                </div>
                @error('text')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="price">Категория:</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach(App\Models\Category::all() as $Category)
                            <option value="{{ $Category->id }}">{{ $Category->category_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="price">Столовая:</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach(App\Models\Place::all() as $Place)
                            <option value="{{ $Place->id }}">{{ $Place->place_name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('place_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="photo">Фотография:</label>
                    <input id="photo" accept="image/*" required class="form-control" type="file" name="photo">
                </div>
                @error('photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success m-b-sm">Добавить новый продукт</button>
            </form>
        </div>
    </div>
    <script src="/js/ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'text' );
    </script>
@endsection
