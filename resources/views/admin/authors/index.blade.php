@extends('layouts.admin')

@section('breadcrumb')
    <li class="active">Авторы</li>
@endsection

@section('content')

    <a href="{{ route('admin.authors.create') }}" type="button" class="btn bg-primary">
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
                <th></th>
            </tr>
            </thead>
            <tbody id="table__dnd">
            @foreach($authors as $author)
                <tr data-id="{{ $author->id }}">
                    <td>
                        <div class="media-left media-middle">
                            <i class="icon-dots dragula-handle"></i>
                        </div>
                    </td>
                    <td>{{ $author->name }}</td>
                    <td>{{ $author->alias }}</td>
                    <td>
                        <div>
                            <a href="{{ route('admin.authors.edit', $author) }}"><i class="icon-pencil7"></i></a>
                            <form method="POST" action="{{ route('admin.authors.destroy', $author) }}" class="form__delete">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="last__btn" data-alias="{{ $author->alias }}">
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
    @push('scripts')
        <script src="{{ asset('dashboard/assets/js/plugins/ui/dragula.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/extension_dnd.js') }}"></script>
    @endpush
@endsection
