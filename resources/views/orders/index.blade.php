@extends('layouts.app_layout')

@section('title', 'Активные заказы')


@section('content')
    <div id="orderApp" class="panel panel-white">
        <div class="panel-body">
            <form action="/export" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary m-b-sm">Экспортировать в Excel</button>
            </form>
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
                            <td>
                                <form action="/changeStatus" method="POST">
                                    @csrf
                                    <input type="hidden" name="orderId" value="{{ $order->id }}">
                                    <select name="newStatus" class="form-control order_status">
                                        @foreach($Statuses as $key => $value)
                                            <option @if($value == $order->status) selected @endif value="{{$key}}">{{$value}}</option>
                                        @endforeach
                                    </select>
                                </form>
                            </td>
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
    <script>
        window.onload = function () {
            let lastId = {{ $lastId }}
            setInterval(function () {
                $.post("/hasUpdate", {
                    'lastId': lastId,
                    '_token': '4DZ9qMNcgsRRzLqHNeWREBUUy6cX9NuI5llmX9Uu'
                }, function (data) {
                    if(data.status === 'Update'){
                        location.reload();
                    }
                })
            }, 3000);
            $('.order_status').on({
                "ready": function (e) {
                    $(this).attr("readonly",true);
                },
                "focus": function (e) {
                    $(this).data( { choice: $(this).val() } );
                },
                "change": function (e) {
                    if($(this).val() === 'Accepted'){
                        $(this).val( $(this).data('choice') );
                        return false;
                    }
                    if ( ! confirm( "Вы уверены, что хотите изменить статус заказа?" ) ){
                        $(this).val( $(this).data('choice') );
                        return false;
                    } else {
                        $(this).attr("readonly",false);
                        $(this).parent().submit();
                        return true;
                    }
                }
            });
        }
    </script>
@endsection
