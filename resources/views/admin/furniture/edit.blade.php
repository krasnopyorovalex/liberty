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
                    <li class="{{ request('active') ? '' : 'active' }}"><a href="#main" data-toggle="tab">Основное</a></li>
                    <li><a href="#images" data-toggle="tab">Слайдер</a></li>
                    <li class="{{ request('active') ? 'active' : '' }}"><a href="#textures" data-toggle="tab">Текстуры</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane {{ request('active') ? '' : 'active' }}" id="main">
                        <form action="{{ route('admin.furniture.update', ['id' => $furniture->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $furniture])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $furniture])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $furniture])
                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $furniture])

                            <div class="row">
                                <div class="col-md-3">
                                    @priceInput(['name' => 'price', 'label' => 'Цена', 'entity' => $furniture])
                                </div>
                                <div class="col-md-9"></div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    @select(['name' => 'collection_id', 'label' => 'Коллекция', 'items' => $collections, 'entity' => $furniture])
                                </div>
                                <div class="col-md-4">
                                    @select(['name' => 'author_id', 'label' => 'Автор мебели', 'items' => $authors, 'entity' => $furniture])
                                </div>
                                <div class="col-md-4">
                                    @select(['name' => 'furniture_type_id', 'label' => 'Тип мебели', 'items' => $furnitureTypes, 'entity' => $furniture])
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

                            <div class="panel panel-flat border-blue border-xs hidden">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Варианты отделок:</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="finishing-options">
                                        @if($furniture->finishing_options)
                                            @foreach($furniture->finishing_options as $value)
                                                <div class="finishing-options-item">
                                                    <input type="text" name="finishing_options[]" class="colorpicker-palette" value="{{ $value }}" data-preferred-format="hex" data-fouc />
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="finishing-options-item">
                                                <input type="text" name="finishing_options[]" class="colorpicker-palette" value="#e0d7c6" data-preferred-format="hex" data-fouc />
                                            </div>
                                        @endif
                                        <div class="btn-box">
                                            <button class="btn btn-primary btn-add" type="button">Добавить вариант</button>
                                            <button class="btn btn-danger btn-remove" type="button">Удалить последний вариант</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @textarea(['name' => 'text', 'label' => 'Описание', 'entity' => $furniture])
                            @textarea(['name' => 'guarantee', 'label' => 'Гарантии', 'entity' => $furniture, 'id' => 'editor-full2'])
                            @textarea(['name' => 'timing', 'label' => 'Сроки', 'entity' => $furniture, 'id' => 'editor-full3'])

                            <div class="row">
                                <div class="col-md-4 image__box-a">
                                    @if ($furniture->image)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($furniture->getDesktopImage()) }}" alt="" class="upload__image">

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
                                <div class="col-md-8 image__box-a">
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
                    <div class="tab-pane image__box-a {{ request('active') ? 'active' : '' }}" id="textures">
                        <form action="{{ route('admin.furniture.store.textures', ['id' => $furniture->id]) }}" enctype="multipart/form-data" method="post">
                            @csrf

                            @if($furniture->textures)
                                <div class="row">
                                    @foreach($furniture->textures as $texture)
                                        <div class="col-md-1 texture-box">
                                            <div class="texture-item">
                                                <img src="{{ asset($texture->path) }}" alt="" class="img-responsive" />
                                                <button type="button"
                                                        data-href="{{ route('admin.furniture.destroy.texture', ['id' => $texture->id]) }}"
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

    <div id="edit-image" class="modal fade"></div>
    @push('scripts')
        <script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/pickers/color/spectrum.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/picker_color.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/ui/dragula.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/extension_dnd.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/plugins/uploaders/fileinput.min.js') }}"></script>
        <script src="{{ asset('dashboard/assets/js/pages/uploader_bootstrap.js') }}"></script>
    @endpush
@endsection
