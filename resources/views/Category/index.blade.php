@extends('Layouts.appLayout')

@section('title', 'Категории товаров')


@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <a href="{{ route('CreateCategory') }}" class="btn btn-success m-b-sm">Добавить новую категорию товаров</a>
            <div class="table-responsive">
                <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
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
                                <form method="post" action="/categorys/{{ $Category->id }}">
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
    <script>
        window.onload = function (){
            $('#example3').DataTable({
                "pagingType": "numbers",
                'language': {
                    "lengthMenu": "Выводить _MENU_ записей на страницу",
                    "zeroRecords": "Ничего не найдено, извините",
                    "info": "Показано страниц _PAGE_ из _PAGES_",
                    "infoEmpty": "Нет данных",
                    "infoFiltered": "(фильтр по _MAX_ кол-ву записей)",
                    "search": "Поиск: ",
                    "paginate": {
                        "first":      "Первая",
                        "last":       "Последняя",
                        "next":       "Следующая",
                        "previous":   "Предыдущая"
                    },
                }
            });
        }
    </script>
@endsection
