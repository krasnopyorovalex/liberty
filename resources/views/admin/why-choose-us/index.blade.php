@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Почему выбирают нас</li>
@endsection

@section('content')

    <a href="{{ route('admin.why_choose_us.create') }}" type="button" class="btn bg-primary">
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
            @foreach($whyChooseUs as $whyChooseUsItem)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $whyChooseUsItem->name }}</td>
                    <td>{!! $whyChooseUsItem->image ? sprintf('<img src="%s" width="80px" />', $whyChooseUsItem->image) : '' !!}</td>
                    <td>{!! $whyChooseUsItem->image_mob ? sprintf('<img src="%s" width="80px" />', $whyChooseUsItem->image_mob) : '' !!}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.why_choose_us.edit', $whyChooseUsItem) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.why_choose_us.destroy', $whyChooseUsItem) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $whyChooseUsItem->alias }}">
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
