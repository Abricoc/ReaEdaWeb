@extends('layouts.app_layout')

@section('title', 'Продукты')


@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <a href="{{ route('CreateProduct') }}" class="btn btn-success m-b-sm">Добавить новый продукт</a>
            <div class="table-responsive">
                <table id="ProductTable" class="display table" style="width: 100%; cellspacing: 0;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Фотография</th>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Категория</th>
                        <th>Столовая</th>
                        <th>Блюдо дня</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($Products as $Product)
                        <tr>
                            <td>{{ $Product->id }}</td>
                            <td><img height="70px" src="{{ $Product->photo }}" alt="{{ $Product->photo }}"></td>
                            <td>{{ $Product->name_product }}</td>
                            <td>{{ $Product->price }}</td>
                            <td>{{ $Product->category->category_name }}</td>
                            <td>{{ $Product->place->place_name }}</td>
                            <td><input onclick="return false;" type="checkbox" @if($Product->dish_of_the_day == 1) checked  @endif"></td>
                            <td>
                                <form class="deleteForm" method="post" action="/products/{{ $Product->id }}">
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
            </div>
        </div>
    </div>
    <script>
        window.onload = function (){
            $('.deleteForm').on('submit', function () {
                return confirm('Вы уверены, что хотите удалить?');
            });

            $('#ProductTable').tablemanager({
                appendFilterby: true,
                disableFilterBy: [1, 2, 7, 8],
                disable: [1, 2, 7, 8],
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
