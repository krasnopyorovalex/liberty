@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.interiors.index') }}">Портфолио</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.interiors.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])

                <div class="row">
                    <div class="col-md-4">
                        @select(['name' => 'interior_type_id', 'label' => 'Тип портфолио', 'items' => $interiorTypes])
                    </div>
                    <div class="col-md-4">
                        @select(['name' => 'author_id', 'label' => 'Автор портфолио', 'items' => $authors])
                    </div>
                    <div class="col-md-4"></div>
                </div>

                @textarea(['name' => 'text', 'label' => 'Описание портфолио в списке'])

                <div class="row">
                    <div class="col-md-6">
                        @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                    </div>
                    <div class="col-md-6">
                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
                    </div>
                </div>

                @checkbox(['name' => 'is_favorite', 'label' => 'Выводить в слайдере Исполнение премиум класса?'])
                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
