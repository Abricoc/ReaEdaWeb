@extends('layouts.app_layout')

@section('title', 'Изменение категории "' . $Model->category_name . '"')

@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <form action="/categorys/edit/{{ $Model->id }}" method="POST">
                @csrf
                {!! method_field('put') !!}
                <div class="form-group">
                    <label for="category_name">Название категории:</label>
                    <input id="category_name" required maxlength="70" class="form-control" type="text" name="category_name" value="{{ $Model->category_name }}">
                </div>
                @error('category_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success m-b-sm">Изменить</button>
            </form>
        </div>
    </div>
@endsection
