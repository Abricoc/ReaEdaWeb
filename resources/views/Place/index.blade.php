@extends('Layouts.appLayout')

@section('title', 'Столовые')


@section('content')
    <div class="panel panel-white">
        <div class="panel-body">
            <a href="{{ route('CreatePlace') }}" class="btn btn-success m-b-sm">Добавить новую столовую</a>
            <div class="table-responsive">
                @if(count($Places))
                <table id="example3" class="display table" style="width: 100%; cellspacing: 0;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Название</th>
                        <th>Фотография</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($Places as $Place)
                        <tr>
                            <td>{{ $Place->id }}</td>
                            <td>{{ $Place->place_name }}</td>
                            <td><img height="70px" src="/images/{{ $Place->place_photo }}" alt="{{ $Place->place_name }}"></td>
                            <td>
                                <form method="post" action="/places/{{ $Place->id }}">
                                    <a title="Посмотреть" href="/places/{{ $Place->id }}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a title="Редактировать" href="/places/edit/{{ $Place->id }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                    {!! method_field('delete') !!}
                                    @csrf
                                    <button style="border: none; background: transparent;" title="Удалить" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $Places->links() }}
                @else
                <h4>Нет столовых</h4>
                @endif
            </div>
        </div>
    </div>
@endsection
