@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Блоки О нас</li>
@endsection

@section('content')

    <a href="{{ route('admin.about_blocks.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Изображение</th>
                <th>Изображение для мобильных устройств</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($aboutBlocks as $aboutBlock)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{!! $aboutBlock->name !!}</td>
                    <td>{!! $aboutBlock->image ? sprintf('<img src="%s" width="80px" />', $aboutBlock->image) : '' !!}</td>
                    <td>{!! $aboutBlock->image_mob ? sprintf('<img src="%s" width="80px" />', $aboutBlock->image_mob) : '' !!}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.about_blocks.edit', $aboutBlock) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.about_blocks.destroy', $aboutBlock) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $aboutBlock->alias }}">
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
