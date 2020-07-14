<table>
    <thead>
    <tr style="border: 1px solid black">
        <th>№ заказа</th>
        <th>Ресторан</th>
        <th>Имя клиента</th>
        <th>Дата создания заказа</th>
        <th>К какому времени заказ</th>
        <th>Статус заказа</th>
        <th>Товары</th>
        <th>Итоговая цена</th>
    </tr>
    </thead>
    <tbody>
    @foreach($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->place_name }}</td>
            <td>{{ $order->user->firstname }}</td>
            <td>{{ date('d.m.Y H:i', strtotime($order->created_at)) }}</td>
            <td>@if($order->select_date == null) Как можно скорее @else {{ date_format($order->select_date, 'd.m.Y H:i') }} @endif</td>
            <td>{{ $order->status }}</td>
            <td>
                @if($order->products != null)
                    @foreach($order->products as $product)
                        {{ $product['product']['name_product'] }} - {{ $product['count'] }}<br>
                    @endforeach
                @endif
            </td>
            <td>{{ $order->final_amount }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
