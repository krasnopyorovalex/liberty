@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.why_choose_us.index') }}">Почему выбирают нас</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.why_choose_us.update', ['id' => $whyChooseUs->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображения</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">
                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $whyChooseUs])
                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $whyChooseUs])
                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="image">
                            <div class="row">
                                <div class="col-md-6 image__box-a">
                                    @if ($whyChooseUs->image)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($whyChooseUs->image) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button" data-href="{{ route('admin.why_choose_us.destroy.img', ['id' => $whyChooseUs->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $whyChooseUs, 'label' => 'Выберите изображение на компьютере(1920x742px)'])
                                </div>
                                <div class="col-md-6 image__box-a">
                                    @if ($whyChooseUs->image_mob)
                                        <div class="panel panel-flat border-blue border-xs">
                                            <div class="panel-body">
                                                <img src="{{ asset($whyChooseUs->image_mob) }}" alt="" class="upload__image">

                                                <div class="btn-group btn__actions">
                                                    <button type="button" data-href="{{ route('admin.why_choose_us.destroy.img.mob', ['id' => $whyChooseUs->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    @imageInput(['name' => 'image_mob', 'type' => 'file', 'entity' => $whyChooseUs, 'label' => 'Выберите изображение на компьютере для мобильных устройств(360x600px)'])
                                </div>
                            </div>
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>

@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
