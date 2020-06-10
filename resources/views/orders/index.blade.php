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
                            <td>{{ date('d.m.Y H:i', strtotime($order->select_date)) }}</td>
                            <td>
                                <select class="form-control order_status">
                                    @foreach($Statuses as $key => $value)
                                        <option @if($value == $order->status) selected @endif value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <a title="Посмотреть" href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
                        return true;
                    }
                }
            });
        }
    </script>
@endsection
