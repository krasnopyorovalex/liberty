@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.pages.index') }}">Страницы</a></li>
    <li class="active">Форма редактирования страницы</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования страницы</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.pages.update', ['id' => $page->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображения</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            @select(['name' => 'slider_id', 'label' => 'Слайдер', 'items' => $sliders, 'entity' => $page])

                            <div class="form-group">
                                <label for="template">Шаблон страницы:</label>
                                <select class="form-control border-blue border-xs select-search" id="template" name="template" data-width="100%">
                                    @foreach ($page->getTemplates() as $key => $value)
                                        <option value="{{ $key }}" {{ $key === $page->template ? 'selected' : '' }}>{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $page])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $page])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $page])

                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $page])
                            @input(['name' => 'sub_title', 'label' => 'Подзаголовок', 'entity' => $page])

                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $page])
                            @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'entity' => $page])

                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="image">
                            <div class="row">
                                <div class="col-md-6">
                                    @if ($page->image)
                                        <div class="panel panel-flat border-blue border-xs" id="image__box">
                                            <div class="panel-body">
                                                <img src="{{ asset($page->image->path) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $page->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $page, 'label' => 'Выберите изображение на компьютере'])
                                </div>
                                <div class="col-md-6 image__box-a">
                                    @if ($page->image_mob)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($page->image_mob) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.pages.destroy.img.mob', ['id' => $page->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'entity' => $page, 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
                                    </div>
                                </div>
                            </div>

                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($page->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $page->image])
    @endif

@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
