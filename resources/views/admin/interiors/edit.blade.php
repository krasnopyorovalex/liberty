@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.interiors.index') }}">Интерьеры</a></li>
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
                        <form action="{{ route('admin.interiors.update', ['id' => $interior->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $interior])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $interior])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $interior])

                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $interior])

                            {{--                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $interior])--}}
                            @checkbox(['name' => 'is_favorite', 'label' => 'Отображать в избранном(слайдер)?', 'entity' => $interior])

                            <div class="row">
                                <div class="col-md-6 image__box-a">
                                    @if ($interior->image)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($interior->image) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.interiors.destroy.img', ['id' => $interior->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $interior, 'label' => 'Выберите изображение на компьютере'])
                                    </div>
                                </div>
                                <div class="col-md-6 image__box-a">
                                    @if ($interior->image_mob)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($interior->image_mob) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button"
                                                            data-href="{{ route('admin.interiors.destroy.img.mob', ['id' => $interior->id]) }}"
                                                            class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">
                                                        Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="text-left">
                                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'entity' => $interior, 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
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
                                    <input type="hidden" name="interiorId" value="{{ $interior->id }}">
                                    <input type="hidden" name="uploadUrl"
                                           value="{{ route('admin.interior_images.store', $interior) }}">
                                    <input type="hidden" name="updatePositionUrl"
                                           value="{{ route('admin.interior_images.update_positions') }}">
                                    <input type="file" class="file-input-ajax" multiple="multiple" name="upload"
                                           accept="image/*">
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        @if ($interior->images)
                            <div id="_images_box">
                                @include('admin.interiors._images_box')
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
    @endpush
@endsection
