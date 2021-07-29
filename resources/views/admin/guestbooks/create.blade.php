@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.guestbooks.index') }}">Отзывы</a></li>
    <li class="active">Форма добавления отзыва</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления отзывва</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.guestbooks.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])

                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                @textarea(['name' => 'text', 'label' => 'Текст'])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection