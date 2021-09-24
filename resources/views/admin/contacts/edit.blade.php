@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.contacts.index') }}">Контакты</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.contacts.update', ['id' => $contact->id]) }}" method="post">
                @csrf
                @method('put')

                @input(['name' => 'name', 'label' => 'Название', 'entity' => $contact])
                @input(['name' => 'map', 'label' => 'Карта', 'entity' => $contact])
                @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $contact])
                @checkbox(['name' => 'is_fabric', 'label' => 'Контакт фабрики?', 'entity' => $contact])

                @submit_btn()

            </form>

        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
    @endpush
@endsection
