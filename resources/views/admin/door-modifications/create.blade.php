@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.doors.index') }}">Двери</a></li>
    <li><a href="{{ route('admin.door_modifications.index', $door) }}">Модификации двери {{ $door->name }}</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>
        <div class="panel-body">
            @include('layouts.partials.errors')
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="{{ request('active') ? '' : 'active' }}"><a href="#main" data-toggle="tab">Основное</a></li>
                    <li><a href="#images" data-toggle="tab">Галерея</a></li>
                    <li class="{{ request('active') ? 'active' : '' }}"><a href="#textures" data-toggle="tab">Текстуры</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane {{ request('active') ? '' : 'active' }}" id="main">
                        <form action="{{ route('admin.doors.update', ['id' => $door->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="parent_id" value="{{ $door->id }}" />
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $door])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $door])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $door])
                            @input(['name' => 'alias', 'label' => 'Alias'])

                            <div class="row">
                                <div class="col-md-3">
                                    @priceInput(['name' => 'price', 'label' => 'Цена', 'entity' => $door])
                                </div>
                                <div class="col-md-3">
                                    @input(['name' => 'articul', 'label' => 'Артикул', 'entity' => $door])
                                </div>
                                <div class="col-md-3">
                                    @select(['name' => 'slider_id', 'label' => 'Верхний слайдер', 'items' => $sliders, 'entity' => $door])
                                </div>
                                <div class="col-md-3">
                                    @select(['name' => 'author_id', 'label' => 'Автор мебели', 'items' => $authors, 'entity' => $door])
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="products">Выберите похожие товары</label>
                                <select class="form-control border-blue border-xs select-search" multiple="multiple" id="products" name="related_doors[]" data-width="100%">
                                    @foreach($doors->whereNotIn('id', [$door->id]) as $item)
                                        <option value="{{ $item->id }}" {{ is_array($door->related_doors) && in_array($item->id, $door->related_doors) ? 'selected' : '' }}>{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            @if(count($doorAttributes))
                                <div class="panel panel-flat border-blue border-xs">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Атрибуты мебели</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            @foreach($doorAttributes as $doorAttribute)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fa-{{ $doorAttribute->id }}">{{ $doorAttribute->name }}</label>
                                                        <input type="text" name="doorAttributes[{{ $doorAttribute->id }}]" value="{{ old('doorAttributes.'. $doorAttribute->id, $door->getdoorAttributeValue($doorAttribute->id)) }}" class="form-control border-blue border-xs" id="fa-{{ $doorAttribute->id }}" autocomplete="off" />
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="panel panel-flat border-blue border-xs hidden">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Варианты отделок:</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="finishing-options">
                                        @if($door->finishing_options)
                                            @foreach($door->finishing_options as $key => $value)
                                                <div class="finishing-options-item form-group">
                                                    <input type="text" name="finishing_options[]" class="form-control colorpicker-palette" value="{{ $value }}" data-preferred-format="hex" data-fouc />
                                                    <input type="text" name="finishing_option_names[]" class="form-control border-blue border-xs finishing-option-names" value="{{ $door->finishing_option_names[$key] ?? '' }}" placeholder="метка" />
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="btn-box">
                                            <button class="btn btn-primary btn-add" type="button">Добавить вариант</button>
                                            <button class="btn btn-danger btn-remove" type="button">Удалить последний вариант</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @textarea(['name' => 'text', 'label' => 'Описание', 'entity' => $door])
                            @textarea(['name' => 'guarantee', 'label' => 'Гарантии', 'entity' => $door, 'id' => 'editor-full2'])
                            @textarea(['name' => 'timing', 'label' => 'Сроки', 'entity' => $door, 'id' => 'editor-full3'])

                            <div class="row">
                                <div class="col-md-4 image__box-a">
{{--                                    @if ($door->image)--}}
{{--                                        <div class="panel panel-flat border-blue border-xs">--}}
{{--                                            <div class="panel-body">--}}
{{--                                                <img src="{{ asset($door->getDesktopImage()) }}" alt="" class="upload__image">--}}

{{--                                                <div class="btn-group btn__actions">--}}
{{--                                                    <button type="button"--}}
{{--                                                            data-href="{{ route('admin.doors.destroy.img', ['id' => $door->id]) }}"--}}
{{--                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">--}}
{{--                                                        Удалить <b><i class="icon-trash"></i></b></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                    <div class="text-left">
                                        @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $door, 'label' => 'Выберите изображение на компьютере(490x480px)'])
                                    </div>
                                </div>
                                <div class="col-md-8 image__box-a">
                                    <div class="form-group">
{{--                                        @if($door->file)--}}
{{--                                            <div class="panel panel-flat border-blue border-xs">--}}
{{--                                                <div class="panel-body">--}}
{{--                                                    <div class="file-3d-box">--}}
{{--                                                        {{ $door->file }}--}}
{{--                                                    </div>--}}
{{--                                                    <button type="button"--}}
{{--                                                            data-href="{{ route('admin.doors.destroy.file', ['id' => $door->id]) }}"--}}
{{--                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">--}}
{{--                                                        Удалить файл<b><i class="icon-trash"></i></b></button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
                                        <label for="file-field">Выберите 3D файл:</label>
                                        <input type="file" class="file-styled-primary file-3d border-blue border-xs" id="file-field" name="file" value="" autocomplete="off" />
                                    </div>
                                </div>
                            </div>

                            @submit_btn()
                        </form>
                    </div>
                    <div class="tab-pane image__box-a {{ request('active') ? 'active' : '' }}" id="textures">
                        <form action="{{ route('admin.doors.store.textures', ['id' => $door->id]) }}" enctype="multipart/form-data" method="post">
                            @csrf

                            @if($door->textures)
                                <div class="row">
                                    @foreach($door->textures as $texture)
                                        <div class="col-md-1 texture-box">
                                            <div class="texture-item">
                                                <img src="{{ asset($texture->path) }}" alt="" class="img-responsive" />
                                                <button type="button"
                                                        data-href="{{ route('admin.doors.destroy.texture', ['id' => $texture->id]) }}"
                                                        class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                    &nbsp;<b><i class="icon-trash"></i></b>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <br />
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="textures">Выберите текстуры на компьютере</label>
                                        <input type="file" id="textures" name="textures[]" multiple required class="file-styled-primary file-3d border-blue border-xs" />
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Загрузить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/plugins/pickers/color/spectrum.js') }}"></script>
<script src="{{ asset('dashboard/assets/js/pages/picker_color.js') }}"></script>
@endpush
@endsection
