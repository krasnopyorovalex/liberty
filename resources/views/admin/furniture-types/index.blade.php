@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Типы мебели</li>
@endsection

@section('content')

    <a href="{{ route('admin.furniture_types.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($furnitureTypes as $furnitureType)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $furnitureType->name }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.furniture_types.edit', $furnitureType) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.furniture_types.destroy', $furnitureType) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn">
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
