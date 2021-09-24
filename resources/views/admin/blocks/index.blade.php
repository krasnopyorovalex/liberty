@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Блоки</li>
@endsection

@section('content')

    <a href="{{ route('admin.blocks.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Системное имя</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($blocks as $block)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $block->name }}</td>
                    <td>{{ $block->sys_name }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.blocks.edit', $block) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.blocks.destroy', $block) }}" class="form__delete">
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
