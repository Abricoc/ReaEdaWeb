@extends('Layouts.appLayout')

@section('title', 'Добавление новой столовой')

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
