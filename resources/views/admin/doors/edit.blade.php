@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.doors.index') }}">.door.</a></li>
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
                        <form action="{{ route('admin.doors.update', ['id' => $door->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $door])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $door])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $door])
                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $door])

                            <div class="row">
                                <div class="col-md-4">
                                    @select(['name' => 'author_id', 'label' => 'Автор мебели', 'items' => $authors, 'entity' => $door])
                                </div>
                                <div class="col-md-4"></div>
                                <div class="col-md-4"></div>
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

                            <div class="panel panel-flat border-blue border-xs">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Варианты отделок:</h5>
                                </div>
                                <div class="panel-body">
                                    <div class="finishing-options">
                                        @if($door->finishing_options)
                                            @foreach($door->finishing_options as $key => $value)
                                                <div class="finishing-options-item form-group">
                                                <input type="text" name="finishing_options[]" class="form-control colorpicker-palette" value="{{ $value }}" data-preferred-format="hex" data-fouc />
                                                <input type="text" name="finishing_option_names[]" class="form-control border-blue border-xs" value="{{ $door->finishing_option_names[$key] ?? '' }}" placeholder="метка" />
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="finishing-options-item form-group">
                                                <input type="text" name="finishing_options[]" class="form-control colorpicker-palette" value="#e0d7c6" data-preferred-format="hex" data-fouc />
                                                <input type="text" name="finishing_option_names[]" class="form-control border-blue border-xs" placeholder="метка" />
                                            </div>
                                        @endif
                                        <div class="btn-box">
                                            <button class="btn btn-primary btn-add" type="button">Добавить вариант</button>
                                            <button class="btn btn-danger btn-remove" type="button">Удалить последний вариант</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @textarea(['name' => 'text', 'label' => 'Описание', 'entity' => $door])

                            <div class="row">
                                <div class="col-md-4 image__box-a">
                                    @if ($door->image)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($door->image) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.doors.destroy.img', ['id' => $door->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $door, 'label' => 'Выберите изображение на компьютере'])
                                    </div>
                                </div>
                                <div class="col-md-4 image__box-a">
                                    @if ($door->image_mob)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($door->image_mob) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.doors.destroy.img.mob', ['id' => $door->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'entity' => $door, 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
                                    </div>
                                </div>
                                <div class="col-md-4 image__box-a">
                                    <div class="form-group">
                                        @if($door->file)
                                            <div class="panel panel-flat border-blue border-xs">
                                                <div class="panel-body">
                                                    <div class="file-3d-box">
                                                        {{ $door->file }}
                                                    </div>
                                                    <button type="button"
                                                            data-href="{{ route('admin.doors.destroy.file', ['id' => $door->id]) }}"
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
                                <div class="type-select-box">
                                    <label for="type-select">Выберите для каких устройств загружаем изображения</label>
                                    <select name="type" id="type-select" class="form-control border-blue border-xs select-search">
                                        <option value="0">Компьютеры</option>
                                        <option value="1">Мобильные</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-12">
                                    <input type="hidden" name="uploadUrl"
                                           value="{{ route('admin.door_images.store', $door) }}">
                                    <input type="hidden" name="updatePositionUrl"
                                           value="{{ route('admin.door_images.update_positions') }}">
                                    <input type="file" class="file-input-ajax" multiple="multiple" name="upload"
                                           accept="image/*">
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        @if ($door->images)
                            <h4 class="text-center">Для компьютеров</h4>
                            <div id="_images_box">
                                @include('admin.doors._images_box')
                            </div>
                        @endif
                        @if ($door->imagesForMobile)
                            <h4 class="text-center">Для мобильных устройств</h4>
                            <div id="_images_box-mob">
                                @include('admin.doors._images_box_mob')
                            </div>
                        @endif
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
