@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Мебель</li>
@endsection

@section('content')

    <a href="{{ route('admin.furniture.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Коллекция</th>
                <th>Автор</th>
                <th>Цена</th>
                <th>Тип</th>
                <th>Слайдер в интерьере</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($furnitureList as $furniture)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $furniture->name }}</td>
                    <td>{{ $furniture->collection->name }}</td>
                    <td>{{ $furniture->author->name }}</td>
                    <td>{!! $furniture->getPrice() !!}</td>
                    <td>{{ $furniture->furnitureType->name }}</td>
                    <td>
                        <a href="{{ route('admin.furniture_interior_sliders.edit', ['id' => $furniture->furnitureInteriorSlider->id, 'furnitureId' => $furniture->id]) }}">
                            [Слайдер "В интерьере"]
                        </a>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('admin.furniture.edit', $furniture) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.furniture.destroy', $furniture) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $furniture->alias }}">
                                    <i class="icon-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
