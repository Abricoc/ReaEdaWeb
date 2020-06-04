@extends('layouts.app_layout')

@section('title', 'Добавление нового ресторана    ')

@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <form enctype="multipart/form-data" action="/places/create" method="POST">
            @csrf
                <div class="form-group">
                    <label for="place_name">Название столовой:</label>
                    <input id="place_name" required maxlength="100" class="form-control" type="text" name="place_name" value="{{ old('place_name') }}">
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
                    <label for="operating_mode">График работы:</label><br>
                    <label><input id="operating_mode" type="radio" checked name="operating_mode" value="five"> 5-ти дневная рабочая неделя</label></br>
                    <label><input id="operating_mode"  type="radio" name="operating_mode" value="six"> 6-ти дневная рабочая неделя</label>
                </div>
                @error('operating_mode')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror


                <div class="form-group">
                    <label for="place_photo">Фотография:</label>
                    <input id="place_photo" required accept="image/*" class="form-control" type="file" name="place_photo">
                </div>
                @error('place_photo')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <button type="submit" class="btn btn-success m-b-sm">Добавить новую столовую</button>
            </form>
        </div>
    </div>
@endsection
