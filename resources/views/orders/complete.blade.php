@extends('layouts.app_layout')

@section('title', 'Активные заказы')


@section('content')
    <div id="orderApp" class="panel panel-white">
        <div class="panel-body">
            <div class="table-responsive">
                <table id="CategorysTable" class="display table" style="width: 100%; cellspacing: 0;">
                    <thead>
                    <tr>
                        <th>№ заказа</th>
                        <th>Ресторан</th>
                        <th>Имя клиента</th>
                        <th>Дата создания заказа</th>
                        <th>К какой дате заказ</th>
                        <th>Статус заказа</th>
                        <th>Товары</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($Orders as $order)
                        <tr>
                            <td>{{ str_pad($order->id, 6 , '0', STR_PAD_LEFT) }}</td>
                            <td>{{ $order->place_name }}</td>
                            <td>{{ $order->user->firstname }}</td>
                            <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
                            <td>@if($order->select_date == null) Как можно скорее @else {{ date_format($order->select_date, 'd.m.Y H:i') }} @endif</td>
                            <td>{{ $order->status }}</td>
                            <td>
                                <a title="Посмотреть" href="/orders/{{ $order->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
