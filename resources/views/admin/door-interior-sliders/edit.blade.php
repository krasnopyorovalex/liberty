@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.doors.index') }}">Двери</a></li>
    <li class="active">Слайдер "В интерьере" для {{ $doorInteriorSlider->door->name }}</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                    <li><a href="#images" data-toggle="tab">Изображения</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="main">
                        <form action="{{ route('admin.door_interior_sliders.update', ['id' => $doorInteriorSlider->id]) }}" method="post">
                            @csrf
                            @method('put')

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $doorInteriorSlider])

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
                                    <input type="hidden" name="doorInteriorSliderId" value="{{ $doorInteriorSlider->id }}">
                                    <input type="hidden" name="uploadUrl" value="{{ route('admin.door_interior_slider_images.store', $doorInteriorSlider) }}">
                                    <input type="hidden" name="updatePositionUrl" value="{{ route('admin.door_interior_slider_images.update_positions') }}">
                                    <input type="file" class="file-input-ajax" multiple="multiple" name="upload" accept="image/*">
                                </div>
                            </div>
                        </form>
                        <div class="clearfix"></div>
                        @if ($doorInteriorSlider->images)
                            <h4 class="text-center">Для компьютеров</h4>
                            <div id="_images_box">
                                @include('admin.door-interior-sliders._images_box')
                            </div>
                        @endif
                        @if ($doorInteriorSlider->imagesForMobile)
                            <h4 class="text-center">Для мобильных устройств</h4>
                            <div id="_images_box-mob">
                                @include('admin.door-interior-sliders._images_box_mob')
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
    @endpush
@endsection
