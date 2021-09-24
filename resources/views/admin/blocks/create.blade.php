@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.blocks.index') }}">Блоки</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.blocks.store') }}" method="post">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'sys_name', 'label' => 'Системное имя для вывода в шаблоне'])
                @textarea(['name' => 'text', 'label' => 'Текст'])
                @submit_btn()
            </form>

        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
