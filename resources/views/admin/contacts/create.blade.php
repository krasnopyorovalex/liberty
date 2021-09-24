@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.contacts.index') }}">Контакты</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.contacts.store') }}" method="post">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'map', 'label' => 'Карта'])
                @textarea(['name' => 'text', 'label' => 'Текст'])
                @checkbox(['name' => 'is_fabric', 'label' => 'Контакт фабрики?'])
                @submit_btn()
            </form>

        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
