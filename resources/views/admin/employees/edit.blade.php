@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.employees.index') }}">Сотрудники</a></li>
    <li class="active">Форма редактирования</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма редактирования</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.employees.update', ['id' => $employee->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="tabbable">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#main" data-toggle="tab">Основное</a></li>
                        <li><a href="#image" data-toggle="tab">Изображение</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="main">

                            @input(['name' => 'name', 'label' => 'Название', 'entity' => $employee])
                            @input(['name' => 'title', 'label' => 'Title', 'entity' => $employee])
                            @input(['name' => 'description', 'label' => 'Description', 'entity' => $employee])

                            @input(['name' => 'alias', 'label' => 'Alias', 'entity' => $employee])

                            @textarea(['name' => 'text', 'label' => 'Текст', 'entity' => $employee])

                            @submit_btn()
                        </div>

                        <div class="tab-pane" id="image">
                            @if ($employee->image)
                                <div class="panel panel-flat border-blue border-xs image__box-a" id="image__box">
                                    <div class="panel-body">
                                        <img src="{{ asset($employee->image->path) }}" alt="" class="upload__image">

                                        <div class="btn-group btn__actions">
                                            <button data-toggle="modal" data-target="#modal_info" type="button" class="btn btn-primary btn-labeled btn-sm"><b><i class="icon-pencil4"></i></b> Атрибуты</button>

                                            <button type="button" data-href="{{ route('admin.images.destroy', ['id' => $employee->image->id]) }}" class="btn delete__img btn-danger btn-labeled btn-labeled-right btn-sm">Удалить <b><i class="icon-trash"></i></b></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            @imageInput(['name' => 'image', 'type' => 'file', 'entity' => $employee, 'label' => 'Выберите изображение на компьютере(264x362px)'])
                            @submit_btn()
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    @if ($employee->image)
        @include('layouts.partials._image_attributes_popup', ['image' => $employee->image])
    @endif

@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
