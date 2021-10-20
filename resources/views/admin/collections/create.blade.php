@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.collections.index') }}">Коллекции</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.collections.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])

                <div class="row">
                    <div class="col-md-6">
                        @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере(1920x600px)'])
                    </div>
                    <div class="col-md-6">
                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'label' => 'Выберите изображение на компьютере для мобильных устройств(400x565px)'])
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        @fileInput(['name' => 'catalog_file', 'type' => 'file', 'label' => 'Выберите каталог на компьютере'])
                    </div>
                    <div class="col-md-6"></div>
                </div>

                @textarea(['name' => 'text', 'label' => 'Превью для списка'])

{{--                @checkbox(['name' => 'is_sales_leader', 'label' => 'Лидер продаж?'])--}}

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
