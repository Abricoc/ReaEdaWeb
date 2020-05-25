@extends('layouts.app_layout')

@section('title', 'Изменение столовой "' . $Model->place_name . '"')

@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <form enctype="multipart/form-data" action="/places/edit/{{ $Model->id }}" method="POST">
                @csrf
                {!! method_field('put') !!}
                <div class="form-group">
                    <label for="place_name">Название столовой:</label>
                    <input id="place_name" required class="form-control" type="text" name="place_name" value="{{ $Model->place_name }}">
                </div>
                @error('place_name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="place_open">Время начала работы ресторана:</label>
                    <input id="place_open" min="08:00" max="21:00" required class="form-control" type="time" name="place_open" value="{{ old('place_open') }}">
                </div>
                @error('place_open')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="form-group">
                    <label for="place_close">Время окончания работы ресторана:</label>
                    <input id="place_close" min="08:00" max="21:00" required class="form-control" type="time" name="place_close" value="{{ old('place_close') }}">
                </div>
                @error('place_close')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="place_photo">Фотография:</label>
                    <input id="place_photo" accept="image/*" class="form-control" type="file" name="place_photo">
                    <img width="500px" src="{{ $Model->place_photo }}" alt="{{ $Model->place_name }}">
                </div>
                @error('place_photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success m-b-sm">Изменить</button>
            </form>
        </div>
    </div>
@endsection
