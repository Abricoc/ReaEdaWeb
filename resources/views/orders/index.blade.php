@extends('layouts.app_layout')

@section('title', 'Активные заказы')


@section('content')
<div class="panel panel-white">
    <div class="panel-body">
        <div class="table-responsive">
            <table id="CategorysTable" class="display table" style="width: 100%; cellspacing: 0;">
                <thead>
                <tr>
                    <th>№ заказа</th>
                    <th>Ресторан</th>
                    <th>Имя клиента</th>
                    <th>К какой дате заказ</th>
                    <th>Статус заказа</th>
                </tr>
                </thead>
                <tbody>
                @foreach($Orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->place_name }}</td>
                        <td>{{ $order->user->firstname }}</td>
                        <td>{{ $order->select_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
