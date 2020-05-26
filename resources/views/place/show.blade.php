@extends('layouts.app_layout')

@section('title',  $Model->place_name)

@section('content')
<div class="panel panel-white">
    <div class="panel-body">
        <div class="form-group">
            <div class="form-group">
                <label>Название столовой:</label>
                <input readonly class="form-control" type="text" value="{{ $Model->place_name }}">
            </div>
            <div class="form-group">
                <label>Время работы:</label>
                <input readonly class="form-control" type="text" value="{{ $Model->place_open }} - {{ $Model->place_close }}">
            </div>
            <div class="form-group">
                <label style="width: 100%">Фотография:</label>
                <img width="500px" src="{{ $Model->place_photo }}" alt="{{ $Model->place_name }}">
            </div>
        </div>
        <a href="/places" class="btn btn-primary m-b-sm">Назад</a>
    </div>
</div>
@endsection
