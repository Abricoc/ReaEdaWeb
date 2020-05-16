@extends('layouts.app_layout')

@section('title',  $Model->place_name)

@section('content')
<div class="panel panel-white">
    <div class="panel-body">
        <div class="form-group">
            <div class="form-group">
                <label for="place_name">Название столовой:</label>
                <input id="place_name" readonly class="form-control" type="text" name="place_name" value="{{ $Model->place_name }}">
            </div>
            <div class="form-group">
                <label for="place_photo">Фотография:</label></div>
                <img width="500px" src="{{ $Model->place_photo }}" alt="{{ $Model->place_name }}">
            </div>
        </div>
        <a href="/places" class="btn btn-primary m-b-sm">Назад</a>
    </div>
</div>
@endsection
