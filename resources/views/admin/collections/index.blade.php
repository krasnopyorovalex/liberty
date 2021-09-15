@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Коллекции</li>
@endsection

@section('content')

    <a href="{{ route('admin.collections.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Alias</th>
                <th>Обновлена</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($collections as $collection)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>
                        <a href="{{ $collection->url }}" target="_blank">{{ strip_tags($collection->name) }} <i class="icon-new-tab "></i></a>
                    </td>
                    <td>{{ $collection->alias }}</td>
                    <td><span class="label label-primary">{{ $collection->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.collections.edit', $collection) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.collections.destroy', $collection) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $collection->alias }}">
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
