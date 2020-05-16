@extends('layouts.app_layout')

@section('title',  $Model->place_name)

@section('content')
<div class="panel panel-white">
    <div class="panel-body">
        <div class="form-group">
            <div class="form-group">
                <label for="category_name">Название категории:</label>
                <input id="category_name" readonly class="form-control" type="text" name="category_name" value="{{ $Model->category_name }}">
            </div>
        </div>
        <a href="/categorys" class="btn btn-primary m-b-sm">Назад</a>
    </div>
</div>
@endsection
