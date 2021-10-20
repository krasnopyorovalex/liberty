@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.collections.index') }}">Коллекции</a></li>
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
                            <form action="{{ route('admin.collections.update', ['id' => $collection->id]) }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                @input(['name' => 'name', 'label' => 'Название', 'entity' => $collection])
                                @input(['name' => 'title', 'label' => 'Title', 'entity' => $collection])
                                @input(['name' => 'description', 'label' => 'Description', 'entity' => $collection])

                                @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $collection])
                                <div class="row">
                                    <div class="col-md-6 image__box-a">
                                        @if ($collection->image)
                                            <div class="panel panel-flat border-blue border-xs">
                                                <div class="panel-body">
                                                    <img src="{{ asset($collection->image) }}" alt="" class="upload__image">

                                                    <div class="btn-group btn__actions">
                                                        <button type="button" data-href="{{ route('admin.collections.destroy.img', ['id' => $collection->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $collection, 'label' => 'Выберите изображение на компьютере(1920x600px)'])
                                    </div>
                                    <div class="col-md-6 image__box-a">
                                        @if ($collection->image_mob)
                                            <div class="panel panel-flat border-blue border-xs">
                                                <div class="panel-body">
                                                    <img src="{{ asset($collection->image_mob) }}" alt="" class="upload__image">

                                                    <div class="btn-group btn__actions">
                                                        <button type="button" data-href="{{ route('admin.collections.destroy.img.mob', ['id' => $collection->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'entity' => $collection, 'label' => 'Выберите изображение на компьютере для мобильных устройств(400x565px)'])
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 image__box-a">
                                        @if ($collection->catalog_file)
                                            <div class="panel panel-flat border-blue border-xs">
                                                <div class="panel-body">
                                                    <p>{{ $collection->catalog_file }}</p>
                                                    <div class="btn-group btn__actions">
                                                        <button type="button" data-href="{{ route('admin.collections.destroy.file', ['id' => $collection->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        @fileInput(['name' => 'catalog_file', 'type' => 'file', 'label' => 'Выберите каталог на компьютере'])
                                    </div>
                                    <div class="col-md-6"></div>
                                </div>

                                @textarea(['name' => 'text', 'label' => 'Превью для списка', 'entity' => $collection])
    {{--                            @checkbox(['name' => 'is_sales_leader', 'label' => 'Лидер продаж?', 'entity' => $collection])--}}

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
                                               value="{{ route('admin.collection_images.store', $collection) }}">
                                        <input type="hidden" name="updatePositionUrl"
                                               value="{{ route('admin.collection_images.update_positions') }}">
                                        <input type="file" class="file-input-ajax" multiple="multiple" name="upload"
                                               accept="image/*">
                                    </div>
                                </div>
                            </form>
                            <div class="clearfix"></div>
                            @if ($collection->images)
                                <h4 class="text-center">Для компьютеров</h4>
                                <div id="_images_box">
                                    @include('admin.collections._images_box')
                                </div>
                            @endif
                            @if ($collection->imagesForMobile)
                                <h4 class="text-center">Для мобильных устройств</h4>
                                <div id="_images_box-mob">
                                    @include('admin.collections._images_box_mob')
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
