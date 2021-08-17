@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.doors.index') }}">Двери</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.doors.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])

                <div class="row">
                    <div class="col-md-3">
                        @priceInput(['name' => 'price', 'label' => 'Цена'])
                    </div>
                    <div class="col-md-9"></div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        @select(['name' => 'slider_id', 'label' => 'Верхний слайдер', 'items' => $sliders])
                    </div>
                    <div class="col-md-4">
                        @select(['name' => 'author_id', 'label' => 'Автор двери', 'items' => $authors])
                    </div>
                    <div class="col-md-4"></div>
                </div>
                @if(count($doorAttributes))
                    <div class="panel panel-flat border-blue border-xs">
                        <div class="panel-heading">
                            <h5 class="panel-title">Атрибуты двери:</h5>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                @foreach($doorAttributes as $doorAttribute)
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fa-{{ $doorAttribute->id }}">{{ $doorAttribute->name }}</label>
                                            <input type="text" name="doorAttributes[{{ $doorAttribute->id }}]" value="{{ old('doorAttributes.'. $doorAttribute->id) }}" class="form-control border-blue border-xs" id="fa-{{ $doorAttribute->id }}" autocomplete="off" />
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="panel panel-flat border-blue border-xs">
                    <div class="panel-heading">
                        <h5 class="panel-title">Варианты отделок:</h5>
                    </div>
                    <div class="panel-body">
                        <div class="finishing-options">
                            <div class="finishing-options-item form-group">
                                <input type="text" name="finishing_options[]" class="colorpicker-palette" value="#e0d7c6" data-preferred-format="hex" data-fouc />
                                <input type="text" name="finishing_option_names[]" class="form-control border-blue border-xs" placeholder="метка"/>
                            </div>
                            <div class="btn-box">
                                <button class="btn btn-primary btn-add" type="button">Добавить вариант</button>
                                <button class="btn btn-danger btn-remove" type="button">Удалить последний вариант</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                    </div>
                    <div class="col-md-4">
                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="file-field">Выберите 3D файл:</label>
                            <input type="file" class="file-styled-primary file-3d border-blue border-xs" id="file-field" name="file" value="" autocomplete="off" />
                        </div>
                    </div>
                </div>

                @textarea(['name' => 'text', 'label' => 'Описание'])
                @textarea(['name' => 'guarantee', 'label' => 'Гарантии', 'id' => 'editor-full2'])
                @textarea(['name' => 'timing', 'label' => 'Сроки', 'id' => 'editor-full3'])
                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/pickers/color/spectrum.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/pages/picker_color.js') }}"></script>
@endpush
@endsection
