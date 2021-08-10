@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.furniture.index') }}">Мебель</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>
        <div class="panel-body">
            @include('layouts.partials.errors')
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    <li><a href="#images" data-toggle="tab">Слайдер</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="main">
                        <form action="{{ route('admin.furniture.update', ['id' => $furniture->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $furniture])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $furniture])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $furniture])

                            <div class="row">
                                <div class="col-md-4">
                                    @select(['name' => 'collection_id', 'label' => 'Коллекция', 'items' => $collections, 'entity' => $furniture])
                                </div>
                                <div class="col-md-4">
                                    @select(['name' => 'author_id', 'label' => 'Автор мебели', 'items' => $authors, 'entity' => $furniture])
                                </div>
                                <div class="col-md-4">
                                    @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $furniture])
                                </div>
                            </div>

                            @if(count($furnitureAttributes))
                                <div class="panel panel-flat border-blue border-xs">
                                    <div class="panel-heading">
                                        <h5 class="panel-title">Атрибуты мебели</h5>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            @foreach($furnitureAttributes as $furnitureAttribute)
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="fa-{{ $furnitureAttribute->id }}">{{ $furnitureAttribute->name }}</label>
                                                        <input type="text" name="furnitureAttributes[{{ $furnitureAttribute->id }}]" value="{{ old('furnitureAttributes.'. $furnitureAttribute->id, $furniture->getFurnitureAttributeValue($furnitureAttribute->id)) }}" class="form-control border-blue border-xs" id="fa-{{ $furnitureAttribute->id }}" autocomplete="off" />
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
                                        @if($furniture->finishing_options)
                                            @foreach($furniture->finishing_options as $value)
                                                <input type="text" name="finishing_options[]" class="form-control colorpicker-palette" value="{{ $value }}" data-preferred-format="hex" data-fouc />
                                            @endforeach
                                        @else
                                            <input type="text" name="finishing_options[]" class="form-control colorpicker-palette" value="#e0d7c6" data-preferred-format="hex" data-fouc />
                                        @endif
                                        <div class="btn-box">
                                            <button class="btn btn-primary btn-add" type="button">Добавить вариант</button>
                                            <button class="btn btn-danger btn-remove" type="button">Удалить последний вариант</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @textarea(['name' => 'text', 'label' => 'Описание', 'entity' => $furniture])

                            <div class="row">
                                <div class="col-md-4 image__box-a">
                                    @if ($furniture->image)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($furniture->image) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.furniture.destroy.img', ['id' => $furniture->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $furniture, 'label' => 'Выберите изображение на компьютере'])
                                    </div>
                                </div>
                                <div class="col-md-4 image__box-a">
                                    @if ($furniture->image_mob)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($furniture->image_mob) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.furniture.destroy.img.mob', ['id' => $furniture->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'entity' => $furniture, 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
                                    </div>
                                </div>
                                <div class="col-md-4 image__box-a">
                                    <div class="form-group">
                                        @if($furniture->file)
                                            <div class="panel panel-flat border-blue border-xs">
                                                <div class="panel-body">
                                                    <div class="file-3d-box">
                                                        {{ $furniture->file }}
                                                    </div>
                                                    <button type="button"
                                                            data-href="{{ route('admin.furniture.destroy.file', ['id' => $furniture->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить файл<b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        @endif
                                        <label for="file-field">Выберите 3D файл:</label>
                                        <input type="file" class="file-styled-primary file-3d border-blue border-xs" id="file-field" name="file" value="" autocomplete="off" />
                                    </div>
                                </div>
                            </div>

                            @submit_btn()
                        </form>
                    </div>
                    <div class="tab-pane" id="images">
                        <form action="#" enctype="multipart/form-data" method="post">
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="hidden" name="furnitureId" value="{{ $furniture->id }}">
                                    <input type="hidden" name="uploadUrl"
                                           value="{{ route('admin.furniture_images.store', $furniture) }}">
                                    <input type="hidden" name="updatePositionUrl"
                                           value="{{ route('admin.furniture_images.update_positions') }}">
                                    <input type="file" class="file-input-ajax" multiple="multiple" name="upload"
                                           accept="image/*">
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        @if ($furniture->images)
                            <div id="_images_box">
                                @include('admin.furniture._images_box')
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="edit-image" class="modal fade"></div>
    @push('scripts')
        <script src="{{ asset('dashboard/assets/js/plugins/ui/dragula.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/extension_dnd.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/uploaders/fileinput.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/uploader_bootstrap.js') }}"></script>
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/pickers/color/spectrum.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/picker_color.js') }}"></script>
    @endpush
@endsection
