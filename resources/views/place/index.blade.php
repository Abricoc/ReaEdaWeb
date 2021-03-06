@extends('layouts.app_layout')

@section('title', 'Рестораны')


@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <a href="/places/create" class="btn btn-success m-b-sm">Добавить новый ресторан</a>
            <div class="table-responsive">
                <table id="PlaceTable" class="display table" style="width: 100%; cellspacing: 0;">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Название</th>
                        <th>Фотография</th>
                        <th>Режим работы</th>
                        <th>Время работы ресторана</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($Places as $Place)
                        <tr>
                            <td>{{ $Place->id }}</td>
                            <td>{{ $Place->place_name }}</td>
                            <td><img height="70px" src="{{ $Place->place_photo }}" alt="{{ $Place->place_name }}"></td>
                            <td>@if($Place->operating_mode) 6-ти дневный  @else 5-ти дневный @endif</td>
                            <td>{{ $Place->place_open }} - {{$Place->place_close}}</td>
                            <td>
                                <form class="deleteForm" method="post" action="/places/{{ $Place->id }}">
                                    <a title="Посмотреть" href="/places/{{ $Place->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a title="Редактировать" href="/places/edit/{{ $Place->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {!! method_field('delete') !!}
                                    @csrf
                                    <button style="border: none; background: transparent;" title="Удалить" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.onload = function (){
            $('.deleteForm').on('submit', function () {
                return confirm('Вы уверены, что хотите удалить?');
            });

            $('#PlaceTable').tablemanager({
                appendFilterby: true,
                disableFilterBy: ["first", 3, "last"],
                disable: ["first", 3, "last"],
                pagination:true,
                showrows: [5,10,20,50,100],
                vocabulary: {
                    voc_filter_by:'Фильтровать по',
                    voc_type_here_filter:'...',
                    voc_show_rows:'Записей на страницу'
                }
            });
        }
    </script>
@endsection
