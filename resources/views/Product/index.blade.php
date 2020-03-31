@extends('Layouts.appLayout')

@section('title', 'Продукты')


@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <a href="{{ route('CreateProduct') }}" class="btn btn-success m-b-sm">Добавить новый продукт</a>
            <div class="table-responsive">
                @if(count($Products))
                <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Фотография</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Категория</th>
                        <th>Столовая</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($Products as $Product)
                        <tr>
                            <td>{{ $Product->id }}</td>
                            <td><img height="70px" src="{{ asset($Product->photo) }}" alt="{{ $Product->photo }}"></td>
                            <td>{{ $Product->name_product }}</td>
                            <td>{{ $Product->price }}</td>
                            <td>{{ $Product->category->category_name }}</td>
                            <td>{{ $Product->place->place_name }}</td>
                            <td>
                                <form method="post" action="/products/{{ $Product->id }}">
                                    <a title="Посмотреть" href="/products/{{ $Product->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a title="Редактировать" href="/products/edit/{{ $Product->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {!! method_field('delete') !!}
                                    @csrf
                                    <button style="border: none; background: transparent;" title="Удалить" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $Products->links() }}
                @else
                <h4>Нет продуктов</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
