<h3>Федеральное государственное бюджетное образовательное учреждение  высшего образования «Российский экономический университет имени Г.В. Плеханова»</h3>
<h3>Российская Федерация, 117997, Москва, Стремянный переулок, д.36</h3>
<h3>ИНН 7705043493/КПП 770501001</h3>
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
