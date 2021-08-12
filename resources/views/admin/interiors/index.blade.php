@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Портфолио</li>
@endsection

@section('content')

    <a href="{{ route('admin.interiors.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Тип</th>
                <th>Alias</th>
                <th>Обновлена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($interiors as $interior)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $interior->name }}</td>
                    <td>{{ $interior->interiorType->name }}</td>
                    <td>{{ $interior->alias }}</td>
                    <td><span class="label label-primary">{{ $interior->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.interiors.edit', $interior) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.interiors.destroy', $interior) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $interior->alias }}">
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
