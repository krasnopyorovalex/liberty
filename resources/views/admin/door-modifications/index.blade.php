@extends('layouts.admin')

@section('breadcrumb')
    <li class="active"><a href="{{ route('admin.doors.index') }}">Двери</a></li>
    <li>Модификации двери {{ $door->name }}</li>
@endsection

@section('content')

    <a href="{{ route('admin.door_modifications.create', $door) }}" type="button" class="btn bg-primary">
        Создать на основе головной коллекции
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Цена</th>
                <th>Слайдер в интерьере</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($doors as $door)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $door->name }}</td>
                    <td>{{ $door->author->name }}</td>
                    <td>{!! $door->getPrice() !!}</td>
                    <td>
                        <a href="{{ route('admin.door_interior_sliders.edit', ['id' => $door->doorInteriorSlider->id, 'doorId' => $door->id]) }}">
                            [Слайдер "В интерьере"]
                        </a>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('admin.door_modifications.edit', $door) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.door_modifications.destroy', $door) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $door->alias }}">
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
