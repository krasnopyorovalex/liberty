@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Двери</li>
@endsection

@section('content')

    <a href="{{ route('admin.doors.create') }}" type="button" class="btn bg-primary">
        Добавить
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
                    <td>
                        <a href="{{ $door->url }}" target="_blank">{{ $door->name }} <i class="icon-new-tab "></i></a>
                    </td>
                    <td>{{ $door->author->name }}</td>
                    <td>{!! $door->getPrice() !!}</td>
                    <td>
                        <a href="{{ route('admin.door_interior_sliders.edit', ['id' => $door->doorInteriorSlider->id, 'doorId' => $door->id]) }}">
                            [Слайдер "В интерьере"]
                        </a>
                    </td>
                    <td>
                        <div>
                            <a href="{{ route('admin.doors.edit', $door) }}"><i class="icon-pencil7"></i></a>
                            <a href="{{ route('admin.door_modifications.index', $door) }}" data-popup="tooltip" title="" data-original-title="Модификации"><i class="icon-tree5"></i></a>
                            <form method="POST" action="{{ route('admin.doors.destroy', $door) }}" class="form__delete">
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
