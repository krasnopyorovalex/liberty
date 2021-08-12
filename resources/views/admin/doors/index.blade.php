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
                <th>Обновлена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($doors as $door)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $door->name }}</td>
                    <td>{{ $door->author->name }}</td>
                    <td><span class="label label-primary">{{ $door->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.doors.edit', $door) }}"><i class="icon-pencil7"></i></a>
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
