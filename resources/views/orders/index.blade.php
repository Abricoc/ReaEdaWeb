@extends('layouts.app_layout')

@section('title', 'Активные заказы')


@section('content')
<div class="panel panel-white">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="CategorysTable" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Categorys as $Category)
                    <tr>
                        <td>{{ $Category->id }}</td>
                        <td>{{ $Category->category_name }}</td>
                        <td>
                            <form class="deleteForm" method="post" action="/categorys/{{ $Category->id }}">
                                <a title="Посмотреть" href="/categorys/{{ $Category->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a title="Редактировать" href="/categorys/edit/{{ $Category->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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

@endsection
