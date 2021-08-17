@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.about_blocks.index') }}">Блоки О нас</a></li>
    <li class="active">Форма добавления</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.about_blocks.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                @input(['name' => 'name', 'label' => 'Название'])

                <div class="row">
                    <div class="col-md-6">
                        @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])
                    </div>
                    <div class="col-md-6">
                        @imageInput(['name' => 'image_mob', 'type' => 'file', 'label' => 'Выберите изображение на компьютере для мобильных устройств'])
                    </div>
                </div>

                @textarea(['name' => 'text', 'label' => 'Текст'])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection
