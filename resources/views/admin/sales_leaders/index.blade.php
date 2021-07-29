@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Лидеры продаж</li>
@endsection

@section('content')

    <a href="{{ route('admin.sales_leaders.create') }}" type="button" class="btn bg-primary">
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
            @foreach($salesLeaders as $salesLeader)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $salesLeader->name }}</td>
                    <td>{{ $salesLeader->alias }}</td>
                    <td><span class="label label-primary">{{ $salesLeader->updated_at->diffForHumans() }}</span></td>
                    <td>
                        <div>
                            <a href="{{ route('admin.sales_leaders.edit', $salesLeader) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.sales_leaders.destroy', $salesLeader) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $salesLeader->alias }}">
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
