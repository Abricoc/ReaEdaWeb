@extends('Layouts.appLayout')

@section('title', 'Добавление новой категории')

@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <form action="/categorys/create" method="POST">
            @csrf
                <div class="form-group">
                    <label for="category_name">Название категории:</label>
                    <input id="category_name" required maxlength="70" class="form-control" type="text" name="category_name" value="{{ old('category_name') }}">
                </div>
                @error('category_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success m-b-sm">Добавить новую категорию</button>
            </form>
        </div>
    </div>
@endsection
