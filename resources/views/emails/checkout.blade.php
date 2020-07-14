<h4><a href="{{$_SERVER['SERVER_NAME'] . '/orders/' . $order->id}}">Заказ №{{ $order->id }}</a></h4>
<h5>Статус заказа: {{ $order->status }}</h5>
<h5>К какому времени:@if($order->select_date == null) Как можно скорее @else {{ date_format($order->select_date, 'd.m.Y H:i') }} @endif</h5>
<h5>Комментарий к заказу: {{ $order->comment }}</h5>
<h5>Ресторан: {{ $order->place_name }}</h5>
<h5>Кто заказал: {{ $order->user->firstname }}</h5>
<h4>Список блюд:</h4>
<table id="CategorysTable" class="display table" style="width: 100%; cellspacing: 0;">
    <thead>
    <tr>
        <th>Название блюда</th>
        <th>Фотография</th>
        <th>Количество</th>
        <th>Стоимость</th>
    </tr>
    </thead>
    <tbody>
    @foreach($order->products as $product)
        <tr>
            <td>{{ $product['product']['name_product'] }}</td>
            <td><img height="70px" src="{{ $_SERVER['SERVER_NAME'] }}{{ $product['product']['photo'] }}" alt="{{ $product['product']['name_product'] }}"></td>
            <td>{{ $product['count'] }}</td>
            <td>{{ $product['price'] }}</td>
        </tr>
    @endforeach
    <tr>
        <td colspan="3"></td>
        <td colspan="1">Итого: {{ $order->final_amount }}</td>
    </tr>
    </tbody>
</table>
