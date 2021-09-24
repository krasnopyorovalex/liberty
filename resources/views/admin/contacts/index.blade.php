@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Контакты</li>
@endsection

@section('content')

    <a href="{{ route('admin.contacts.create') }}" type="button" class="btn bg-primary">
        Добавить
        <i class="icon-stack-plus position-right"></i>
    </a>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr class="border-solid">
                <th>#</th>
                <th>Название</th>
                <th>Контакт фабрики?</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
                <tr>
                    <td><span class="label label-primary">{{ $loop->iteration }}</span></td>
                    <td>{{ $contact->name }}</td>
                    <td>{{ $contact->is_fabric ? 'Да' : 'Нет' }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.contacts.edit', $contact) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="form__delete">
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
