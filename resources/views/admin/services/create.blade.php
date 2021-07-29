@extends('layouts.admin')

@section('breadcrumb')
    <li><a href="{{ route('admin.services.index') }}">Услуги</a></li>
    <li class="active">Форма добавления услуги</li>
@endsection

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">Форма добавления услуги</div>

        <div class="panel-body">

            @include('layouts.partials.errors')

            <form action="{{ route('admin.services.store') }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="parent_id">Родительская услуга</label>
                    <select class="form-control border-blue border-xs select-search" id="parent_id" name="parent_id" data-width="100%">
                        <option value="">Не выбрано</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="portfolios">Выберите портфолио</label>
                    <select class="form-control border-blue border-xs select-search" multiple="multiple" id="portfolios" name="portfolios[]" data-width="100%">
                        @foreach($portfolios as $portfolio)
                            <option value="{{ $portfolio->id }}">{{ $portfolio->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="icon_id">Выберите иконку</label>
                    <select class="form-control border-blue border-xs select-icons" id="icon_id" name="icon" data-width="100%">
                        @foreach ($service->getIcons() as $key => $value)
                            <option value="{{ $key }}" data-icon="{{ $key }}">
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="services">Выберите сопутствующие услуги</label>
                    <select class="form-control border-blue border-xs select-search" multiple="multiple" id="services" name="services[]" data-width="100%">
                        @foreach($services as $service)
                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @if ($service->services)
                                @foreach ($service->services as $subService)
                                        <option value="{{ $subService->id }}">*** {{ $subService->name }}</option>
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>

                @input(['name' => 'name', 'label' => 'Название'])
                @input(['name' => 'slogan', 'label' => 'Слоган'])
                @input(['name' => 'title_block', 'label' => 'Название блока для дочерних услуг'])
                @input(['name' => 'menu_name', 'label' => 'Название в меню'])
                @input(['name' => 'title', 'label' => 'Title'])
                @input(['name' => 'description', 'label' => 'Description'])
                @input(['name' => 'alias', 'label' => 'Alias'])
                @input(['name' => 'price', 'label' => 'Цена'])

                @imageInput(['name' => 'image', 'type' => 'file', 'label' => 'Выберите изображение на компьютере'])

                @textarea(['name' => 'preview', 'label' => 'Превью услуги', 'id' => 'editor-full2'])
                @textarea(['name' => 'text', 'label' => 'Текст'])
                @checkbox(['name' => 'is_published', 'label' => 'Опубликовано?', 'isChecked' => true])
                @checkbox(['name' => 'is_showed_dev_stages', 'label' => 'Отображать блок - Этапы разработки сайта?'])

                @submit_btn()
            </form>

        </div>
    </div>
@push('scripts')
<script src="{{ asset('dashboard/ckeditor/ckeditor.js') }}"></script>
@endpush
@endsection